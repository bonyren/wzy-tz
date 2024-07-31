<?php
 namespace app\index\controller; use app\index\logic\Extra; use app\index\logic\Meeting; use app\index\logic\Enterprise as EnterpriseLogic; use think\Log; class Meetings extends Common { public function index($search = array(), $page = 1, $rows = DEFAULT_PAGE_ROWS, $sort = "\x6d\56\x69\144", $order = "\144\145\x73\143", $filters = array(), $readOnly = 0) { goto sErO5; jn8eV: TkXzs: goto r0J6L; GhJKd: $this->assign("\162\145\x61\144\x4f\156\154\171", $readOnly); goto j1pbn; DJTl2: $data = Meeting::I()->load($search, $page, $rows, $sort, $order, $filters); goto Otv8N; r0J6L: Log::notice("\x6d\145\145\x74\151\156\147\40\151\156\x64\x65\x78\x20" . var_export($filters, true)); goto DJTl2; sErO5: if (!$this->request->isGet()) { goto TkXzs; } goto tPLGJ; j1pbn: return $this->fetch(); goto jn8eV; tPLGJ: $bind = ["\x75\162\x6c\x73" => ["\x6c\151\x73\164" => url("\x69\156\144\x65\170\57\x4d\x65\x65\164\151\156\x67\x73\57\x69\156\144\x65\170", ["\146\151\x6c\x74\145\x72\x73" => $filters])]]; goto MNKzz; MNKzz: $this->assign("\142\x69\x6e\x64", $bind); goto GhJKd; Otv8N: return json($data); goto kdCZ3; kdCZ3: } public function feedback($meeting_id) { goto G1opw; pGDnb: $formData = input("\160\x6f\x73\164\56\x66\x6f\x72\x6d\x44\141\164\141\57\x61"); goto h7T_K; Fx2E1: BPOlD: goto pGDnb; IKqCr: return $this->fetch("\x63\157\x6d\155\x6f\156\57\155\x69\x73\x73\x69\x6e\147"); goto iXm0E; G1opw: if (!$this->request->isGet()) { goto BPOlD; } goto rXIY2; rSC5h: UKANo: goto Gasdw; qfqsn: $principle = $enterprise["\x65\170\164\162\x61"]["\160\162\x69\156\x63\x69\160\154\x65"]; goto dtelT; Gasdw: $meeting["\x72\x65\x6c\x61\x74\x65\x5f\x69\x74\x65\155"] = $enterprise["\x6e\141\155\145"]; goto qfqsn; rXIY2: $meeting = Meeting::I()->getMeeting($meeting_id); goto lMpYc; dtelT: $this->assign(["\155\145\x65\x74\x69\x6e\147" => $meeting, "\160\162\x69\156\143\x69\x70\154\145" => $principle, "\x75\162\154\163" => ["\x66\145\145\144\142\x61\143\x6b" => url("\151\156\x64\145\x78\57\x4d\x65\145\164\151\156\147\163\x2f\146\145\x65\144\x62\x61\x63\153", ["\155\x65\145\164\151\x6e\x67\137\x69\144" => $meeting_id])]]); goto Np2Cw; K3izG: return ajaxSuccess("\345\x8f\x8d\351\xa6\210\346\x88\220\345\212\237"); goto Avydh; d3Gkd: $enterprise = EnterpriseLogic::I()->getEnterprise($meeting["\162\145\x6c\x61\x74\145\x5f\151\x64"]); goto nsz6Z; nsz6Z: if (!empty($enterprise)) { goto UKANo; } goto D6X4l; D6X4l: return $this->fetch("\x63\x6f\155\155\x6f\156\x2f\155\x69\163\x73\151\156\147"); goto rSC5h; lMpYc: if (!empty($meeting)) { goto Xa87n; } goto IKqCr; iXm0E: Xa87n: goto d3Gkd; h7T_K: Meeting::I()->feedbackMeeting($meeting_id, $formData); goto K3izG; Np2Cw: return $this->fetch(); goto Fx2E1; Avydh: } public function view($meeting_id) { goto cpud6; QwIi2: return $this->fetch(); goto r6TEb; WLoCx: if (!empty($enterprise)) { goto arJoS; } goto B55jM; LS6b_: $this->assign("\160\x72\x69\156\143\x69\160\154\x65", $principle); goto QwIi2; JwjJ5: return $this->fetch("\x63\x6f\155\155\157\x6e\57\155\151\x73\163\151\x6e\147"); goto eZTRV; dkcht: if (!empty($meeting)) { goto Ij922; } goto JwjJ5; X1oPr: $this->assign("\162\x65\141\144\x6f\156\154\171", true); goto XIqb_; C9XXV: $enterprise = EnterpriseLogic::I()->getEnterprise($meeting["\162\x65\x6c\141\x74\x65\x5f\151\144"]); goto WLoCx; XIqb_: $this->assign("\155\145\x65\164\151\x6e\x67", $meeting); goto LS6b_; eZTRV: Ij922: goto C9XXV; dOcb9: $principle = $enterprise["\x65\x78\x74\162\x61"]["\x70\162\x69\156\x63\x69\160\x6c\x65"]; goto X1oPr; B55jM: return $this->fetch("\x63\x6f\x6d\155\x6f\156\57\x6d\151\x73\x73\151\x6e\x67"); goto UbA1c; dF0_G: $meeting["\x72\145\x6c\x61\x74\145\x5f\x69\x74\x65\155"] = $enterprise["\156\x61\x6d\145"]; goto dOcb9; cpud6: $meeting = Meeting::I()->getMeeting($meeting_id); goto dkcht; UbA1c: arJoS: goto dF0_G; r6TEb: } }