<?php
 namespace app\index\controller; use think\Controller; use think\Log; use think\Debug; use think\Request; use app\index\logic\Defs; class Funds extends Common { public function funds($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\x66\165\x6e\x64\137\151\x64", $order = "\141\163\143") { goto RcM1Y; RcM1Y: if (!request()->isGet()) { goto d4Dd_; } goto T5yVb; P9Yp_: return json($fundsLogic->load($search, $page, $rows, $sort, $order)); goto HZ_7g; eBbVg: $fundsLogic = \app\index\logic\Funds::newObj(); goto P9Yp_; YX5i5: d4Dd_: goto eBbVg; T5yVb: $urlHrefs = ["\x66\165\156\144\163" => url("\x69\156\x64\x65\170\x2f\x46\165\x6e\144\x73\x2f\146\x75\x6e\x64\163"), "\146\165\156\144\163\101\144\144" => url("\151\156\x64\x65\170\x2f\x46\165\x6e\x64\163\x2f\146\165\x6e\144\x73\x41\x64\x64"), "\146\x75\x6e\144\163\105\x64\151\164" => url("\151\156\144\x65\x78\57\x46\x75\156\x64\163\57\x66\165\156\x64\163\105\x64\x69\x74"), "\146\x75\x6e\144\163\x44\145\x6c\145\x74\145" => url("\x69\x6e\x64\x65\170\57\x46\165\x6e\144\x73\x2f\146\165\x6e\x64\163\x44\x65\154\145\164\145"), "\146\165\x6e\144\163\x50\162\x6f\147\x72\145\x73\163" => url("\x69\x6e\144\145\170\x2f\120\x72\157\147\x72\x65\163\x73\114\x6f\x67\163\x2f\x69\156\144\x65\x78", ["\143\141\164\145\147\x6f\162\171" => \app\index\logic\ProgressLogs::EVENT_LOG_FUND_MANAGE_CATEGORY]), "\146\165\x6e\x64\163\x56\151\145\x77" => url("\x69\x6e\x64\x65\170\57\106\165\156\144\163\x2f\146\165\156\x64\x73\x56\151\145\167")]; goto Xx32c; iBePr: return $this->fetch(); goto YX5i5; Xx32c: $this->assign("\165\162\154\x48\162\145\146\x73", $urlHrefs); goto iBePr; HZ_7g: } public function fundsAdd() { goto NGtcH; xK02C: $infos = input("\x70\157\163\x74\x2e\151\x6e\x66\x6f\x73\57\141"); goto bB9_w; Epphf: dvtbK: goto xK02C; hEzQ_: $result = $fundsLogic->addFund($infos); goto jfV8o; Yss4E: $urlHrefs = []; goto e3Ap3; bB9_w: $fundsLogic = \app\index\logic\Funds::newObj(); goto hEzQ_; mmDfr: return $this->fetch(); goto Epphf; S6sJB: return ajaxError("\345\244\xb1\350\xb4\xa5"); goto qmqgS; jfV8o: if ($result) { goto OW34k; } goto S6sJB; iSeT2: return ajaxSuccess("\xe6\210\220\xe5\212\x9f"); goto k9rss; NGtcH: if (!request()->isGet()) { goto dvtbK; } goto Yss4E; qmqgS: goto PzoRF; goto lGYQs; k9rss: PzoRF: goto T2Fon; e3Ap3: $this->assign("\x75\x72\154\110\x72\145\146\163", $urlHrefs); goto mmDfr; lGYQs: OW34k: goto iSeT2; T2Fon: } public function fundsEdit($fundId, $status = \app\index\logic\Funds::FUND_ALL_STATUS) { goto mjHi7; TM6Rs: if ($infos) { goto ddddx; } goto BErID; yTlBS: return $this->fetch(); goto nE0kh; hHP4d: $infos = $fundsLogic->getFundInfos($fundId); goto TM6Rs; mjHi7: $fundsLogic = \app\index\logic\Funds::newObj(); goto EMN85; CWxFP: $urlHrefs = ["\x66\x75\x6e\144\163\102\141\x73\151\x63" => url("\x69\x6e\x64\145\170\57\106\x75\x6e\144\x73\57\x66\x75\x6e\144\163\102\x61\163\x69\143", ["\x66\x75\x6e\x64\x49\x64" => $fundId]), "\146\165\156\144\163\117\x76\145\x72\x76\151\145\x77" => url("\x69\x6e\x64\x65\170\57\x46\x75\156\144\x73\x2f\146\x75\156\144\x73\x4f\166\145\162\166\151\145\167", ["\146\165\156\144\x49\144" => $fundId]), "\146\x75\156\144\x73\120\x72\x6f\147\x72\145\x73\163\105\166\145\x6e\164" => url("\x69\156\x64\x65\170\x2f\120\x72\x6f\x67\162\145\163\163\x4c\x6f\147\x73\57\154\x69\x67\150\x74", ["\x63\141\x74\x65\147\x6f\x72\x79" => \app\index\logic\ProgressLogs::EVENT_LOG_FUND_MANAGE_CATEGORY, "\145\x78\x74\145\162\x6e\x61\x6c\x49\x64" => $fundId]), "\x66\165\156\x64\163\103\157\154\x6c\145\x63\x74" => url("\151\x6e\144\145\170\x2f\x46\x75\x6e\x64\163\103\x6f\154\x6c\x65\143\164\x2f\x66\165\156\x64\x73\103\x6f\x6c\154\145\143\x74", ["\x66\165\156\144\111\144" => $fundId]), "\146\x75\156\x64\163\111\x6e\166\x65\163\164\120\x72\157\x6a\x65\x63\164\x73" => url("\151\156\x64\x65\x78\57\x46\x75\156\x64\163\x2f\146\165\x6e\x64\163\x49\156\166\145\163\x74\x50\x72\157\152\x65\143\x74\163", ["\x66\x75\156\x64\111\x64" => $fundId]), "\146\165\x6e\144\163\106\x69\x6e\141\x6e\143\x65" => url("\x69\156\x64\x65\170\57\x66\x75\x6e\x64\163\x46\151\156\141\x6e\143\x65\x2f\146\165\156\x64\163\x46\x69\x6e\141\156\x63\145", ["\146\x75\156\x64\x49\144" => $fundId]), "\x66\165\x6e\144\163\104\151\x73\160\141\164\143\150" => url("\151\156\x64\x65\x78\57\146\x75\156\144\x73\104\x69\163\160\141\164\x63\150\57\x66\165\x6e\144\163\104\151\163\160\141\164\143\150", ["\146\165\156\x64\111\x64" => $fundId]), "\x66\x75\x6e\x64\x73\x4d\x61\156\x61\147\145\101\x72\143\x68\151\166\145\163" => url("\151\156\x64\x65\x78\x2f\x66\x75\x6e\x64\x73\115\x61\156\x61\x67\x65\x2f\x66\165\x6e\144\x73\115\x61\x6e\x61\x67\145\x41\x72\143\x68\x69\166\145\x73", ["\x66\x75\x6e\144\111\144" => $fundId])]; goto tDAIL; dYghM: ddddx: goto Hnt7u; Hnt7u: $bindValues = ["\x73\164\141\164\x75\x73\106\151\x6c\x74\145\162" => $status]; goto h2HPU; EMN85: if (!request()->isGet()) { goto W_prR; } goto hHP4d; h2HPU: $this->assign("\142\x69\156\x64\x56\141\154\x75\x65\x73", $bindValues); goto CWxFP; nE0kh: W_prR: goto hXGyB; BErID: return $this->fetch("\143\157\155\x6d\157\156\x2f\145\x72\x72\x6f\162"); goto dYghM; tDAIL: $this->assign("\x75\x72\x6c\110\x72\x65\x66\x73", $urlHrefs); goto yTlBS; hXGyB: } public function fundsDelete($fundId) { goto KFRnC; KFRnC: $fundsLogic = \app\index\logic\Funds::newObj(); goto quKx9; vId11: return ajaxSuccess("\346\x88\x90\xe5\x8a\237"); goto LKhyf; quKx9: try { $fundsLogic->deleteFund($fundId); } catch (\Exception $e) { return ajaxError($e->getMessage()); } goto vId11; LKhyf: } public function fundsView($fundId, $status = \app\index\logic\Funds::FUND_ALL_STATUS) { goto qmqBO; jF9FM: $urlHrefs = ["\x66\165\156\144\163\114\157\x67" => url("\x69\x6e\144\x65\170\57\101\165\x64\151\164\x4c\157\147\163\57\x69\156\144\145\170", ["\155\157\144\x65\x6c\x73" => implode("\137", ["\x46\x75\x6e\x64\x73", "\x46\165\x6e\144\x73\103\x6f\154\x6c\145\143\164", "\106\x75\156\x64\163\x46\x69\x6e\141\156\x63\145\x43\x6f\156\x74\162\151\x62\x75\164\x65\163", "\106\165\x6e\x64\x73\x46\x69\156\x61\x6e\143\x65\105\156\164\145\x72\160\x72\151\x73\145\163", "\x46\165\x6e\144\x73\106\151\156\x61\156\x63\x65\x46\145\x65\x73", "\x46\x75\156\144\163\x46\151\156\141\x6e\143\145\x49\x6e\143\x6f\155\x65\163", "\106\x75\156\x64\x73\x46\151\156\x61\x6e\x63\x65\x54\x61\x78\145\x73", "\x46\x75\156\144\x73\120\x61\162\x74\x6e\x65\x72\163", "\101\164\x74\x61\143\150\155\145\156\164\163", "\127\157\x72\153\x53\164\x61\x74\x75\x73"]), "\162\x65\143\x6f\x72\x64\x49\x64" => $fundId]), "\x66\165\156\144\163\x42\x61\x73\x69\143" => url("\x69\156\x64\x65\x78\57\106\165\156\x64\x73\57\146\x75\x6e\144\x73\x42\x61\x73\x69\143", ["\146\165\156\144\111\x64" => $fundId, "\x72\x65\141\x64\x4f\x6e\154\x79" => 1]), "\146\x75\x6e\144\x73\117\166\145\162\166\x69\145\167" => url("\151\x6e\144\145\170\57\x46\x75\156\x64\x73\x2f\146\x75\x6e\144\x73\117\x76\145\x72\166\151\x65\x77", ["\146\165\156\x64\111\x64" => $fundId, "\162\145\141\x64\117\156\x6c\x79" => 1]), "\146\x75\x6e\144\x73\120\x72\157\147\x72\145\x73\163\105\166\145\x6e\164" => url("\151\x6e\144\x65\x78\57\x50\162\x6f\x67\x72\145\x73\163\x4c\157\x67\163\x2f\x6c\x69\x67\x68\164", ["\143\x61\x74\145\147\157\162\171" => \app\index\logic\ProgressLogs::EVENT_LOG_FUND_MANAGE_CATEGORY, "\145\170\x74\x65\x72\156\141\154\x49\144" => $fundId, "\162\x65\x61\144\117\156\154\171" => 1]), "\x66\165\156\144\x73\x43\157\x6c\x6c\145\143\164" => url("\x69\x6e\x64\145\x78\x2f\106\165\156\144\163\x43\x6f\154\154\145\x63\x74\x2f\x66\x75\x6e\x64\163\103\157\154\x6c\x65\143\x74", ["\x66\x75\x6e\144\x49\144" => $fundId, "\162\145\141\144\x4f\x6e\x6c\171" => 1]), "\146\x75\156\144\x73\111\x6e\166\145\x73\x74\120\x72\157\152\145\x63\164\x73" => url("\x69\156\144\x65\170\x2f\106\x75\156\144\x73\57\146\165\156\144\x73\x49\156\x76\x65\163\x74\120\162\x6f\x6a\145\x63\164\163", ["\146\x75\x6e\144\111\144" => $fundId, "\x72\x65\141\x64\x4f\156\154\171" => 1]), "\146\165\x6e\144\x73\106\151\x6e\141\x6e\x63\145" => url("\x69\156\x64\x65\x78\x2f\x66\x75\x6e\144\163\106\151\x6e\141\x6e\143\x65\x2f\146\165\156\x64\163\106\x69\x6e\141\x6e\143\x65", ["\146\165\x6e\x64\x49\144" => $fundId, "\x72\x65\141\x64\x4f\156\x6c\x79" => 1]), "\x66\x75\x6e\144\x73\x44\151\x73\160\141\x74\x63\150" => url("\151\x6e\x64\145\170\57\x66\x75\156\x64\x73\x44\151\x73\160\141\164\x63\150\57\x66\x75\156\144\x73\x44\x69\x73\x70\141\x74\143\150", ["\x66\x75\156\144\111\x64" => $fundId, "\x72\x65\141\144\117\156\154\171" => 1]), "\146\x75\x6e\x64\163\115\141\156\141\147\145\101\x72\143\150\x69\x76\x65\x73" => url("\x69\156\144\145\170\x2f\x66\x75\156\x64\163\115\141\156\x61\x67\x65\57\146\165\156\144\163\x4d\x61\x6e\x61\x67\145\x41\x72\x63\x68\x69\166\145\163", ["\146\x75\x6e\x64\111\144" => $fundId, "\162\x65\x61\x64\x4f\156\154\x79" => 1])]; goto TaVat; yUrx3: $this->assign("\x62\151\x6e\x64\x56\141\154\x75\145\163", $bindValues); goto jF9FM; en1SK: $infos = $fundsLogic->getFundInfos($fundId); goto FGF1p; ctum7: return $this->fetch(); goto G1PDo; sesGG: NbnKJ: goto k2zbz; TaVat: $this->assign("\165\x72\x6c\110\x72\145\x66\163", $urlHrefs); goto ctum7; qmqBO: $fundsLogic = \app\index\logic\Funds::newObj(); goto pC3AF; FGF1p: if ($infos) { goto NbnKJ; } goto NNxzy; G1PDo: FPKem: goto q35UV; k2zbz: $bindValues = ["\163\x74\141\164\x75\x73\106\x69\154\x74\x65\x72" => $status]; goto yUrx3; pC3AF: if (!request()->isGet()) { goto FPKem; } goto en1SK; NNxzy: return $this->fetch("\143\x6f\155\x6d\157\156\57\145\162\x72\157\x72"); goto sesGG; q35UV: } public function fundsOverview($fundId, $readOnly = 0) { goto dl_j5; HAih7: $this->assign("\165\162\x6c\x48\x72\145\x66\x73", $urlHrefs); goto mZ2f9; mZ2f9: return $this->fetch(); goto ndz93; dl_j5: $urlHrefs = ["\x6d\x69\154\x65\x73\164\x6f\156\x65\163" => url("\151\x6e\144\x65\x78\57\115\151\x6c\x65\x73\164\157\x6e\x65\163\x2f\x69\156\x64\x65\170", ["\x63\141\x74\145\x67\157\162\x79" => \app\index\model\Milestones::MILESTONE_FUND_CATEGORY, "\162\x65\143\157\162\144\111\x64" => $fundId])]; goto HAih7; ndz93: } public function fundsBasic($fundId, $readOnly = 0) { goto RuWBj; Zx6cb: $infos = $fundsLogic->getFundInfos($fundId); goto aZBRp; O3X5f: $urlHrefs = ["\146\x75\x6e\144\163\102\141\163\151\143" => url("\151\156\144\x65\170\57\x46\x75\156\144\x73\57\146\x75\x6e\x64\163\x42\141\x73\x69\143", ["\146\165\x6e\x64\x49\x64" => $fundId])]; goto bIPV6; xv5VX: $this->assign("\162\145\x61\144\x4f\x6e\154\171", $readOnly); goto KWBmM; fpuhY: try { $fundsLogic->editFund($fundId, $infos); } catch (\Exception $e) { return ajaxError($e->getMessage()); } goto YhdXP; u9FG8: $infos = input("\x70\x6f\x73\164\56\x69\156\x66\x6f\x73\x2f\x61"); goto fpuhY; RuWBj: $fundsLogic = \app\index\logic\Funds::newObj(); goto N5lr7; Xhnhf: return $this->fetch("\143\157\x6d\155\157\x6e\x2f\145\x72\162\x6f\x72"); goto Jzdq5; KWBmM: return $this->fetch(); goto XPle6; aZBRp: if ($infos) { goto qljZr; } goto Xhnhf; mGH1k: $bindValues = ["\151\156\x66\157\163" => $infos]; goto MCtva; YhdXP: return ajaxSuccess("\346\x88\220\xe5\212\x9f"); goto v0Z9z; N5lr7: if (!request()->isGet()) { goto wvE44; } goto Zx6cb; bIPV6: $this->assign("\x75\x72\x6c\110\162\x65\x66\163", $urlHrefs); goto xv5VX; Jzdq5: qljZr: goto mGH1k; XPle6: wvE44: goto u9FG8; MCtva: $this->assign("\142\x69\x6e\144\126\141\154\x75\x65\x73", $bindValues); goto O3X5f; v0Z9z: } public function fundsCollect($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\x66\165\x6e\144\x5f\x69\144", $order = "\x64\145\163\143") { goto BdLls; noz62: return $this->fetch(); goto QJCCF; BdLls: if (!request()->isGet()) { goto tRAtu; } goto uyasi; ka5Sj: $this->assign("\x75\162\154\x48\x72\x65\x66\163", $urlHrefs); goto noz62; jacVC: return json($fundsLogic->load($search, $page, $rows, $sort, $order, \app\index\logic\Funds::FUND_COLLECT_STATUS)); goto gnLXp; QJCCF: tRAtu: goto B8OKd; uyasi: $urlHrefs = ["\x66\x75\156\x64\163\103\x6f\154\x6c\145\143\164" => url("\x69\156\144\145\x78\57\106\x75\156\144\x73\57\146\x75\156\144\163\103\157\x6c\154\x65\143\x74", ["\163\x74\141\x74\x75\163" => \app\index\logic\Funds::FUND_COLLECT_STATUS]), "\x66\165\156\144\x73\101\144\144" => url("\x69\156\x64\x65\x78\x2f\106\x75\156\144\163\57\x66\165\x6e\144\163\101\144\144"), "\x66\x75\x6e\144\163\x45\144\151\164" => url("\151\x6e\144\145\170\x2f\x46\x75\156\144\x73\57\x66\x75\156\x64\163\105\144\151\x74", ["\163\x74\x61\x74\x75\163" => \app\index\logic\Funds::FUND_COLLECT_STATUS]), "\x66\x75\x6e\144\163\x44\145\x6c\145\x74\x65" => url("\x69\156\x64\x65\170\57\106\x75\x6e\x64\x73\x2f\x66\165\x6e\x64\163\104\x65\154\x65\x74\x65"), "\146\165\156\x64\x73\120\162\157\x67\x72\145\163\x73" => url("\x69\156\x64\145\170\57\120\x72\157\x67\162\145\x73\163\x4c\x6f\x67\163\x2f\151\x6e\144\x65\170", ["\143\141\164\x65\x67\x6f\162\x79" => \app\index\logic\ProgressLogs::EVENT_LOG_FUND_MANAGE_CATEGORY]), "\x66\x75\x6e\x64\163\120\141\162\x74\156\145\x72\163" => url("\151\x6e\x64\x65\x78\x2f\106\x75\x6e\144\x73\x43\x6f\154\154\x65\143\164\x2f\146\x75\x6e\144\163\x43\157\x6c\154\x65\143\x74\x50\141\162\x74\x6e\145\x72\x73"), "\146\x75\156\144\x73\126\151\145\x77" => url("\x69\x6e\x64\145\x78\57\x46\x75\x6e\x64\163\x2f\146\165\156\144\x73\126\151\x65\167", ["\163\164\x61\x74\x75\163" => \app\index\logic\Funds::FUND_COLLECT_STATUS])]; goto ka5Sj; B8OKd: $fundsLogic = \app\index\logic\Funds::newObj(); goto jacVC; gnLXp: } public function fundsInvest($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\x66\165\x6e\x64\x5f\151\144", $order = "\144\145\163\x63") { goto twXZ1; AhKFG: return $this->fetch(); goto jgRvI; twXZ1: if (!request()->isGet()) { goto WARTi; } goto YXRvg; jgRvI: WARTi: goto iSs8p; TWakt: $this->assign("\165\x72\x6c\110\x72\145\x66\163", $urlHrefs); goto AhKFG; iSs8p: $fundsLogic = \app\index\logic\Funds::newObj(); goto EKuB8; YXRvg: $urlHrefs = ["\146\x75\156\144\x73\111\156\166\x65\163\x74" => url("\151\156\x64\x65\x78\x2f\x46\x75\156\x64\x73\x2f\146\x75\x6e\144\163\111\x6e\x76\145\163\164", ["\x73\x74\141\x74\165\163" => \app\index\logic\Funds::FUND_INVEST_STATUS]), "\x66\165\156\144\163\126\151\x65\167" => url("\x69\156\144\145\x78\x2f\x46\x75\156\144\x73\57\x66\x75\156\144\163\126\151\145\x77", ["\x73\164\141\164\x75\163" => \app\index\logic\Funds::FUND_INVEST_STATUS]), "\146\165\x6e\x64\163\120\x72\157\147\162\x65\163\x73" => url("\x69\x6e\144\x65\170\x2f\x50\x72\x6f\x67\162\x65\163\x73\114\x6f\x67\x73\x2f\151\156\x64\145\x78", ["\x63\141\164\x65\x67\157\x72\x79" => \app\index\logic\ProgressLogs::EVENT_LOG_FUND_MANAGE_CATEGORY]), "\x66\165\x6e\x64\163\x45\144\x69\x74" => url("\151\x6e\144\145\x78\57\x46\165\x6e\x64\163\57\x66\x75\156\144\163\x45\144\x69\164", ["\163\x74\x61\x74\x75\163" => \app\index\logic\Funds::FUND_INVEST_STATUS])]; goto TWakt; EKuB8: return json($fundsLogic->load($search, $page, $rows, $sort, $order, \app\index\logic\Funds::FUND_INVEST_STATUS)); goto vALv3; vALv3: } public function fundsManage($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\x66\165\156\x64\137\151\144", $order = "\144\145\x73\143") { goto LEiEw; D_Dn4: $this->assign("\165\162\154\x48\x72\145\146\x73", $urlHrefs); goto xALK4; LHcn3: F3nsU: goto VnJCO; LEiEw: if (!request()->isGet()) { goto F3nsU; } goto I1c__; I1c__: $urlHrefs = ["\146\165\x6e\x64\163\115\141\x6e\141\x67\x65" => url("\151\x6e\144\x65\x78\x2f\106\x75\x6e\144\x73\x2f\x66\165\156\144\163\115\141\156\x61\147\145", ["\x73\164\141\x74\x75\x73" => \app\index\logic\Funds::FUND_MANAGE_STATUS]), "\x66\165\x6e\x64\163\x45\144\151\164" => url("\x69\156\144\x65\x78\x2f\106\165\156\144\x73\57\146\x75\x6e\144\x73\x45\144\x69\x74", ["\163\x74\x61\x74\x75\163" => \app\index\logic\Funds::FUND_MANAGE_STATUS]), "\146\165\156\x64\x73\x56\x69\145\x77" => url("\151\x6e\x64\x65\x78\x2f\x46\165\156\x64\163\57\x66\165\x6e\x64\163\126\151\x65\167", ["\163\x74\x61\164\x75\163" => \app\index\logic\Funds::FUND_MANAGE_STATUS]), "\146\165\156\x64\163\x50\162\157\x67\x72\x65\x73\163" => url("\x69\x6e\144\x65\x78\57\x50\162\x6f\147\x72\145\163\x73\114\157\147\x73\x2f\x69\156\144\145\170", ["\143\x61\x74\x65\147\157\x72\x79" => \app\index\logic\ProgressLogs::EVENT_LOG_FUND_MANAGE_CATEGORY]), "\146\165\x6e\144\163\106\151\156\141\156\x63\x65" => url("\151\x6e\x64\145\x78\x2f\146\165\156\x64\163\106\151\x6e\141\x6e\143\x65\57\146\x75\x6e\144\163\106\x69\x6e\141\156\143\145"), "\x66\165\x6e\144\x73\x44\151\163\x70\141\x74\143\150" => url("\151\156\x64\145\170\x2f\x66\x75\156\x64\163\x44\x69\x73\160\141\x74\x63\150\x2f\x66\x75\x6e\x64\x73\104\x69\x73\x70\x61\164\143\x68"), "\146\x75\156\144\163\x4d\x61\156\x61\147\145\x41\162\143\x68\x69\x76\x65\x73" => url("\x69\x6e\x64\x65\x78\57\x46\x75\x6e\x64\x73\115\x61\x6e\141\147\x65\57\146\x75\156\144\x73\x4d\141\156\141\x67\145\x41\162\x63\x68\151\166\145\x73"), "\x66\x75\x6e\144\163\x4d\x61\156\x61\147\x65\x45\x76\145\156\x74" => url("\151\x6e\144\x65\170\x2f\120\x72\157\x67\162\145\x73\163\114\x6f\147\x73\x2f\x69\x6e\144\x65\170", ["\x63\x61\164\x65\147\157\162\x79" => \app\index\logic\ProgressLogs::EVENT_LOG_FUND_MANAGE_CATEGORY])]; goto D_Dn4; VnJCO: $fundsLogic = \app\index\logic\Funds::newObj(); goto K7xvi; xALK4: return $this->fetch(); goto LHcn3; K7xvi: return json($fundsLogic->load($search, $page, $rows, $sort, $order, \app\index\logic\Funds::FUND_MANAGE_STATUS)); goto lSUWB; lSUWB: } public function fundsExit($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\x66\x75\x6e\x64\137\x69\x64", $order = "\144\x65\x73\143") { goto pgjOO; uZjCH: $this->assign("\165\162\x6c\x48\162\145\x66\x73", $urlHrefs); goto RVWkE; pgjOO: if (!request()->isGet()) { goto veT5E; } goto FUNYL; rJQbz: return json($fundsLogic->load($search, $page, $rows, $sort, $order, \app\index\logic\Funds::FUND_EXIT_STATUS)); goto NToU2; vbh15: veT5E: goto cdI4S; RVWkE: return $this->fetch(); goto vbh15; FUNYL: $urlHrefs = ["\x66\165\156\144\163\x45\170\x69\x74" => url("\x69\x6e\144\145\x78\x2f\106\x75\156\144\163\x2f\146\x75\x6e\144\x73\105\x78\x69\164", ["\x73\x74\141\164\x75\x73" => \app\index\logic\Funds::FUND_EXIT_STATUS]), "\x66\165\156\x64\x73\126\151\x65\x77" => url("\151\x6e\144\x65\x78\x2f\x46\x75\156\144\x73\x2f\x66\165\156\x64\163\126\151\145\167")]; goto uZjCH; cdI4S: $fundsLogic = \app\index\logic\Funds::newObj(); goto rJQbz; NToU2: } public function changeStatus($fundId, $fromStatus, $toStatus) { goto cpAda; b6U7J: $fundsLogic->changeStatus($fundId, $fromStatus, $toStatus); goto ZgihW; ZgihW: return ajaxSuccess("\xe6\x88\x90\xe5\x8a\x9f"); goto xoEpY; cpAda: $fundsLogic = \app\index\logic\Funds::newObj(); goto b6U7J; xoEpY: } public function fundsInvestProjects($fundId, $readOnly = 0) { goto kCMWz; sINpz: $enterprises = $enterpriseLogic->getInvestEnterprise($fundId); goto cyjFR; CtSP7: $this->assign("\165\x72\154\110\162\145\146\163", $urlHrefs); goto Z5BUG; cyjFR: return json(["\164\157\x74\x61\x6c" => count($enterprises), "\x72\x6f\x77\x73" => $enterprises]); goto LWfNh; h0Gyw: return $this->fetch(); goto BoEft; BoEft: Kg6uh: goto l_j7F; kCMWz: if (!request()->isGet()) { goto Kg6uh; } goto w4udW; w4udW: $urlHrefs = ["\x66\x75\156\144\163\x49\x6e\166\145\163\x74\120\x72\x6f\152\145\x63\164\x73" => url("\x69\x6e\x64\x65\170\57\106\x75\x6e\x64\163\x2f\x66\x75\x6e\144\163\111\x6e\x76\145\x73\164\x50\162\157\152\x65\143\164\163", ["\146\165\156\144\x49\x64" => $fundId])]; goto CtSP7; l_j7F: $enterpriseLogic = \app\index\logic\Enterprise::I(); goto sINpz; Z5BUG: $this->assign("\x72\145\141\144\117\x6e\154\x79", $readOnly); goto h0Gyw; LWfNh: } }
