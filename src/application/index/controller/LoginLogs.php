<?php
 namespace app\index\controller; use think\Controller; use think\Log; use think\Debug; use think\Request; use app\index\logic\Defs; class LoginLogs extends Common { public function index($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\151\144", $order = "\144\145\163\x63") { goto NyXtR; Ifify: $loginLogsLogic = \app\index\logic\LoginLogs::newObj(); goto cm9Zm; GveIL: return $this->fetch(); goto qNq8K; T3VP4: $this->assign("\165\x72\154\x48\162\145\146\x73", $urlHrefs); goto GveIL; qNq8K: roktc: goto Ifify; NyXtR: if (!request()->isGet()) { goto roktc; } goto r6ICk; r6ICk: $urlHrefs = ["\x69\156\x64\145\170" => url("\151\x6e\144\x65\170\57\x4c\157\147\151\x6e\114\x6f\x67\x73\57\151\156\x64\x65\170")]; goto T3VP4; cm9Zm: return json($loginLogsLogic->load($search, $page, $rows, $sort, $order)); goto v0Jnt; v0Jnt: } }
