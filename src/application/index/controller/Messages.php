<?php
 namespace app\index\controller; use think\Controller; use think\Log; use think\Debug; use think\Request; use app\index\logic\Defs; class Messages extends Common { public function index($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\155\145\163\163\x61\147\x65\137\x69\x64", $order = "\144\x65\x73\x63") { goto Xsuzs; JKXiP: $this->assign("\165\162\x6c\x48\162\145\x66\163", $urlHrefs); goto Z3rpD; ke1Vb: $urlHrefs = ["\151\156\x64\145\170" => url("\x69\156\x64\x65\170\x2f\115\145\163\x73\141\x67\145\x73\x2f\x69\156\144\x65\x78"), "\x63\157\x6e\x74\145\x6e\164" => url("\x69\156\x64\145\x78\x2f\x4d\x65\x73\163\141\147\x65\163\57\143\x6f\x6e\x74\x65\156\x74")]; goto JKXiP; sV8I9: g5ri0: goto ym3LZ; iRt06: return json($messagesLogic->load($this->loginUserId, $search, $page, $rows, $sort, $order)); goto U4yll; Xsuzs: if (!request()->isGet()) { goto g5ri0; } goto ke1Vb; Z3rpD: return $this->fetch(); goto sV8I9; ym3LZ: $messagesLogic = \app\index\logic\Messages::newObj(); goto iRt06; U4yll: } public function markRead($messageId) { goto vVJjh; UAQig: $messagesLogic->markRead($messageId); goto wHt_e; vVJjh: $messagesLogic = \app\index\logic\Messages::newObj(); goto UAQig; wHt_e: return ajaxSuccess("\xe6\210\x90\345\x8a\237"); goto ywNby; ywNby: } public function markAllRead() { goto Qhxa3; giQrj: return ajaxSuccess("\xe6\210\220\xe5\212\237"); goto pQ0a0; Qhxa3: $messagesLogic = \app\index\logic\Messages::newObj(); goto qolt2; qolt2: $messagesLogic->markAllRead($this->loginUserId); goto giQrj; pQ0a0: } public function markSelectedRead() { goto XictV; K2IDK: return ajaxSuccess("\346\210\220\345\x8a\237"); goto GbLgv; uZcnI: $messageIds = input("\160\x6f\x73\164\x2e\x6d\145\x73\x73\x61\x67\145\111\144\163\57\141"); goto TwK2P; XictV: $messagesLogic = \app\index\logic\Messages::newObj(); goto uZcnI; ASurB: $messagesLogic->markSelectedRead($messageIds); goto K2IDK; TwK2P: if (!empty($messageIds)) { goto a1D5X; } goto kjUVm; KqH7P: a1D5X: goto ASurB; kjUVm: return ajaxSuccess("\346\x88\220\345\212\x9f"); goto KqH7P; GbLgv: } public function content($messageId) { goto FiERC; IlqSH: return $this->fetch(); goto a_xcS; vgS1S: if (!empty($infos)) { goto osyRz; } goto b8Nx9; HCkbz: $this->assign("\143\x6f\156\x74\x65\156\164", $infos["\143\157\156\x74\145\156\x74"]); goto IlqSH; FiERC: $messagesLogic = \app\index\logic\Messages::newObj(); goto xa9oT; b8Nx9: return $this->fetch("\x63\x6f\155\155\x6f\x6e\57\145\x72\x72\157\162"); goto JtNH_; xa9oT: $infos = $messagesLogic->getInfos($messageId); goto vgS1S; JtNH_: osyRz: goto HCkbz; a_xcS: } }
