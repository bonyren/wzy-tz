<?php
 namespace app\index\controller; use think\Controller; use app\index\logic\Dashboard as DashboardLogic; class Dashboard extends Common { public function dashboard() { goto RW83i; A84xR: $bindValues = ["\x73\x74\141\x74\151\x73\164\x69\x63" => $dashboardLogic->loadStatistic()]; goto ehp6H; RW83i: $dashboardLogic = DashboardLogic::newObj(); goto A84xR; tI321: return $this->fetch(); goto cMFZ2; ehp6H: $this->assign("\142\x69\156\x64\126\141\154\x75\x65\163", $bindValues); goto tI321; cMFZ2: } public function fundLatest() { goto nbun2; xiEIq: $urlHrefs = ["\x66\165\156\144\x4c\x61\164\145\163\164" => url("\x69\x6e\144\x65\x78\x2f\104\x61\x73\150\x62\157\x61\x72\x64\57\x66\165\x6e\144\114\141\x74\145\x73\164")]; goto t9s4m; DCqpV: return json($dashboardLogic->loadFundLatest()); goto JkzVA; t9s4m: $this->assign("\165\x72\x6c\x48\162\x65\x66\163", $urlHrefs); goto lOXSd; nbun2: if (!request()->isGet()) { goto b33St; } goto xiEIq; YQxO1: b33St: goto SA3vx; lOXSd: return $this->fetch(); goto YQxO1; SA3vx: $dashboardLogic = \app\index\logic\Dashboard::newObj(); goto DCqpV; JkzVA: } public function enterpriseLatest() { goto IM53R; tMmjx: return json($dashboardLogic->loadEnterpriseLatest()); goto EQ2rY; siFpi: cx6fV: goto UDmHM; vsk0T: $urlHrefs = ["\145\156\x74\145\162\160\x72\151\x73\145\x4c\141\x74\145\163\x74" => url("\151\x6e\x64\145\170\57\x44\x61\163\x68\142\x6f\x61\162\144\x2f\145\156\164\x65\162\160\x72\x69\163\145\114\141\x74\x65\x73\164")]; goto cEnk3; UDmHM: $dashboardLogic = \app\index\logic\Dashboard::newObj(); goto tMmjx; cEnk3: $this->assign("\x75\162\154\x48\162\145\146\163", $urlHrefs); goto JhJ5h; JhJ5h: return $this->fetch(); goto siFpi; IM53R: if (!request()->isGet()) { goto cx6fV; } goto vsk0T; EQ2rY: } }