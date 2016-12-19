<?php

namespace App\Http\Controllers\Admin;

use App\Models\Answer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Website;
use App\Models\Article;

class IndexController extends AdminController {

    /**
     * 显示后台首页
     */
    public function index() {
        /* 生成Labels */
        $labelTimes = $chartLabels = $countHit = $artCountHit = [];

        for ($i = 0; $i <= 7; $i++) {
            $labelTimes[$i] = Carbon::createFromTimestamp(Carbon::now()->timestamp - (7 - $i) * 24 * 3600);
            $chartLabels[$i] = '"' . $labelTimes[$i]->month . '月-' . $labelTimes[$i]->day . '日' . '"';
        }
        //网站点击量统计
        $sum = Website::select(DB::raw('DATE_FORMAT(`created_at`,\'%Y-%m-%d\') as dates,SUM(`web_views`) as sum'))
                ->where('created_at', '>', $labelTimes[0])
                ->where('created_at', '<', $labelTimes[7])
                ->groupBy('dates')
                ->get();
        //文章点击量统计
        $artSum = Article::select(DB::raw('DATE_FORMAT(`created_at`,\'%Y-%m-%d\') as dates,SUM(`art_views`) as sum'))->where('created_at', '>', $labelTimes[0])
                ->where('created_at', '<', $labelTimes[7])
                ->groupBy('dates')
                ->get();
        $systemInfo = $this->getSystemInfo();
        if (!empty($sum)) {
            foreach ($sum as $v) {
                $countHit[$v->dates] = $v->sum;
            }
        }
        if (!empty($artSum)) {
            foreach ($artSum as $va) {
                $artCountHit[$va->dates] = $va->sum;
            }
        }
        $count = $artCount = [0, 0, 0, 0, 0, 0, 0];
        for ($i = 0; $i <= 7; $i++) {
            $d = date('Y-m-d', $labelTimes[$i]->timestamp);
            isset($countHit[$d]) &&$count[$i] = $countHit[$d];
            isset($artCountHit[$d])&&$artCount = $artCountHit[$d];
        }
        return view("admin.index.index")->with(compact('chartLabels', 'count', 'artCount', 'systemInfo'));
    }

    /* 显示或隐藏sidebar */

    public function sidebar(Request $request) {
        Cookie::forget('sidebar_collapse');
        $cookie = Cookie::forever('sidebar_collapse', $request->get('collapse'));
        return response()->json('ok')->withCookie($cookie);
    }

    private function drawUserChart() {

        /* 生成Labels */
        $labelTimes = $chartLabels = [];

        for ($i = 0; $i <= 7; $i++) {
            $labelTimes[$i] = Carbon::createFromTimestamp(Carbon::now()->timestamp - (7 - $i) * 24 * 3600);
            $chartLabels[$i] = '"' . $labelTimes[$i]->month . '月-' . $labelTimes[$i]->day . '日' . '"';
        }

        $users = WechatUser::select(DB::raw('DATE_FORMAT(created_at,\'%Y-%m-%d\') dates,count(*) as cunt'))
                ->where('created_at', '>', $labelTimes[0])
                ->where('created_at', '<', $labelTimes[7])
                ->groupBy('dates')
                ->get();

        $coutUser = [];
        foreach ($users as $val) {
            $coutUser[$val->dates] = $val->cunt;
        }

        $registerRange = $verifyRange = $authRange = [0, 0, 0, 0, 0, 0, 0, 0];
        for ($i = 0; $i <= 7; $i++) {
            $d = date('Y-m-d', $labelTimes[$i]->timestamp);
            if (isset($coutUser[$d])) {
                $registerRange[$i] = $coutUser[$d];
            }
        }

        return ['labels' => $chartLabels, 'registerUsers' => $registerRange, 'verifyUsers' => $verifyRange, 'authUsers' => $authRange];
    }

    private function drawQuestionChart() {

        /* 生成Labels */
        $labelTimes = $chartLabels = [];
        for ($i = 0; $i < 7; $i++) {
            $labelTimes[$i] = Carbon::createFromTimestamp(Carbon::now()->timestamp - (7 - $i) * 24 * 3600);
            $chartLabels[$i] = '"' . $labelTimes[$i]->month . '月-' . $labelTimes[$i]->day . '日' . '"';
        }

        $questions = Question::where('created_at', '>', $labelTimes[0])->where('created_at', '<', $labelTimes[6])->get();
        $answers = Answer::where('created_at', '>', $labelTimes[0])->where('created_at', '<', $labelTimes[6])->get();
        $articles = Article::where('created_at', '>', $labelTimes[0])->where('created_at', '<', $labelTimes[6])->get();

        $questionRange = $answerRange = $articleRange = [0, 0, 0, 0, 0, 0, 0];

        for ($i = 0; $i < 7; $i++) {
            /* 问题统计 */
            foreach ($questions as $question) {
                if ($i === 6 && $question->created_at->timestamp > $labelTimes[$i]->timestamp) {
                    $questionRange[$i] ++;
                    break;
                }
                if ($question->created_at->timestamp > $labelTimes[$i]->timestamp && $question->created_at->timestamp < $labelTimes[$i + 1]->timestamp) {
                    $questionRange[$i] ++;
                }
            }
            /* 回答统计 */
            foreach ($answers as $answer) {
                if ($i === 6 && $answer->created_at->timestamp > $labelTimes[$i]->timestamp) {
                    $answerRange[$i] ++;
                    break;
                }
                if ($answer->created_at->timestamp > $labelTimes[$i]->timestamp && $answer->created_at->timestamp < $labelTimes[$i + 1]->timestamp) {
                    $answerRange[$i] ++;
                }
            }
            /* 文章统计 */
            foreach ($articles as $article) {
                if ($i === 6 && $article->created_at->timestamp > $labelTimes[$i]->timestamp) {
                    $articleRange[$i] ++;
                    break;
                }
                if ($article->created_at->timestamp > $labelTimes[$i]->timestamp && $article->created_at->timestamp < $labelTimes[$i + 1]->timestamp) {
                    $articleRange[$i] ++;
                }
            }
        }

        return [
            'labels' => $chartLabels,
            'questionRange' => $questionRange,
            'answerRange' => $answerRange,
            'articleRange' => $articleRange,
        ];
    }

    private function getSystemInfo() {
        $systemInfo['phpVersion'] = PHP_VERSION;
        $systemInfo['runOS'] = PHP_OS;
        $systemInfo['maxUploadSize'] = ini_get('upload_max_filesize');
        $systemInfo['maxExecutionTime'] = ini_get('max_execution_time');
        $systemInfo['hostName'] = $_SERVER['SERVER_NAME'] . ' / ' . $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'];
        $systemInfo['serverInfo'] = $_SERVER['SERVER_SOFTWARE'];
        return $systemInfo;
    }

}
