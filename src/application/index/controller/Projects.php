<?php
 namespace app\index\controller; use think\Controller; use think\Log; use think\Debug; use think\Request; class Projects extends Common { public function projects($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\160\162\x6f\x6a\145\143\x74\x5f\151\144", $order = "\x64\145\x73\x63") { goto jtnA4; E2HZQ: $urlHrefs = ["\x70\162\157\x6a\x65\x63\164\x73" => url("\151\x6e\x64\145\x78\x2f\120\162\x6f\x6a\x65\x63\164\163\57\160\162\x6f\x6a\x65\143\164\x73")]; goto XOJLl; XOJLl: $this->assign("\x75\162\154\110\x72\145\x66\163", $urlHrefs); goto dyCIw; qvIC2: pE9qh: goto ks5or; ks5or: return json(["\x74\x6f\x74\x61\154" => 0, "\162\157\x77\163" => []]); goto dHm7W; dyCIw: return $this->fetch(); goto qvIC2; jtnA4: if (!request()->isGet()) { goto pE9qh; } goto E2HZQ; dHm7W: } }
