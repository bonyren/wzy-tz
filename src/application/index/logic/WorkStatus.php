<?php
 namespace app\index\logic; use app\index\model\Setting; use think\Debug; use think\Db; use think\Log; use think\Request; use think\Session; class WorkStatus extends Base { public function getInfos($category, $recordId) { goto EOdXu; I3C0D: if ($infos) { goto OvPi9; } goto xf6ly; EOdXu: $infos = Db::table("\x77\157\162\153\x5f\163\x74\141\164\x75\163")->where(["\143\x61\x74\145\147\157\x72\171" => $category, "\162\x65\143\157\162\144\x5f\151\144" => $recordId])->field(true)->find(); goto I3C0D; BCIsv: return $infos; goto MDm2w; PQhOW: OvPi9: goto BCIsv; xf6ly: return false; goto PQhOW; MDm2w: } public function getDefaultInfos() { return ["\x77\x6f\x72\153\x65\162\x73" => '', "\x73\x74\141\164\165\163" => '', "\146\151\x6e\x69\x73\x68\145\144\x5f\144\x61\164\x65" => '']; } public function save($category, $recordId, $infos) { goto Pl06c; vYY2g: \app\index\logic\Milestones::newObj()->delete(\app\index\model\Milestones::MILESTONE_FUND_CATEGORY, $recordId); goto n2Fk4; Au0Vs: if ($model) { goto A4adm; } goto nyk6U; nADA5: $model->category = $category; goto KBsk9; BexvM: \app\index\logic\Milestones::newObj()->save(\app\index\model\Milestones::MILESTONE_FUND_CATEGORY, $recordId, $datas["\x66\151\x6e\x69\163\150\x65\144\x5f\144\x61\x74\x65"], "\345\xb7\xa5\345\x95\x86\346\263\250\345\x86\214\xe5\xae\x8c\xe6\210\220"); goto HJwjq; HJwjq: tZVpt: goto nADA5; KRcyr: $model = model("\x57\x6f\162\x6b\x53\x74\141\164\x75\x73"); goto o_eIS; cy8Nz: $model->status = !emptyInArray($infos, "\163\x74\141\x74\x75\x73") ? $infos["\163\x74\141\x74\x75\x73"] : \app\index\model\WorkStatus::WORK_WORKING_STATUS; goto RF3nP; qQPFL: if (!($model->status == \app\index\model\WorkStatus::WORK_WORKING_STATUS && $datas["\163\164\x61\164\x75\163"] == \app\index\model\WorkStatus::WORK_FINISHED_STATUS)) { goto tZVpt; } goto j5KyJ; nyk6U: $datas["\x63\141\x74\x65\x67\157\x72\171"] = $category; goto NDxjN; Pl06c: $datas = []; goto o4ghN; uWAkY: $model->workers = !emptyInArray($infos, "\x77\157\162\x6b\145\x72\163") ? $infos["\x77\x6f\x72\153\x65\162\x73"] : ''; goto cy8Nz; cGdtO: A4adm: goto qQPFL; o_eIS: $model->data($datas); goto QIZbx; LXtR8: goto veyfD; goto cGdtO; n2Fk4: \app\index\logic\Milestones::newObj()->save(\app\index\model\Milestones::MILESTONE_FUND_CATEGORY, $recordId, $datas["\146\151\156\151\x73\150\145\144\137\144\x61\x74\145"], "\xe5\267\xa5\345\x95\206\xe6\263\250\345\x86\214\345\256\214\346\210\220"); goto AbyFb; QIZbx: $model->save(); goto jhYkx; KBsk9: $model->record_id = $recordId; goto uWAkY; j5KyJ: \app\index\logic\Milestones::newObj()->delete(\app\index\model\Milestones::MILESTONE_FUND_CATEGORY, $recordId); goto BexvM; bFvKk: $model->save(); goto RMPqF; RMPqF: veyfD: goto JiKbt; NDxjN: $datas["\x72\x65\143\x6f\x72\x64\137\151\144"] = $recordId; goto KRcyr; o4ghN: $datas["\167\157\x72\x6b\x65\162\163"] = !emptyInArray($infos, "\167\x6f\162\x6b\x65\x72\163") ? $infos["\x77\157\162\x6b\x65\x72\163"] : ''; goto Gude3; Gude3: $datas["\x73\164\141\x74\x75\x73"] = !emptyInArray($infos, "\163\164\141\x74\165\163") ? $infos["\163\x74\x61\x74\x75\163"] : \app\index\model\WorkStatus::WORK_WORKING_STATUS; goto hvIqM; AbyFb: J56qm: goto LXtR8; hvIqM: $datas["\x66\x69\x6e\151\163\x68\x65\144\137\x64\x61\x74\145"] = !emptyInArray($infos, "\146\x69\x6e\x69\163\x68\145\x64\x5f\144\x61\x74\145") ? $infos["\x66\151\x6e\x69\x73\150\145\144\x5f\x64\141\x74\145"] : Defs::DEFAULT_DB_DATE_VALUE; goto cRRJP; RF3nP: $model->finished_date = !emptyInArray($infos, "\146\151\x6e\x69\163\x68\x65\144\x5f\144\x61\164\x65") ? $infos["\146\x69\x6e\151\x73\150\x65\144\137\144\141\x74\145"] : Defs::DEFAULT_DB_DATE_VALUE; goto bFvKk; jhYkx: if (!($datas["\163\x74\141\164\x75\x73"] == \app\index\model\WorkStatus::WORK_FINISHED_STATUS)) { goto J56qm; } goto vYY2g; cRRJP: $model = \app\index\model\WorkStatus::get(["\143\141\164\x65\x67\x6f\x72\171" => $category, "\162\x65\143\157\x72\x64\137\151\x64" => $recordId]); goto Au0Vs; JiKbt: } }
