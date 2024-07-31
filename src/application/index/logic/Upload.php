<?php
 namespace app\index\logic; use think\Db; use think\Log; use app\index\model\Attachments; use app\common\CommonDefs; class Upload extends Base { const ATTACH_ENTERPRISE_EXIT_PROTOCOL = 23; const ATTACH_ENTERPRISE_EXIT_DELIVERY = 24; const ATTACH_FUND_PARTNER_AGREEMENT = 100; const ATTACH_FUND_COLLECT_PLAN_OTHER = 101; const ATTACH_FUND_COLLECT_BP = 102; const ATTACH_FUND_FILING_LETTER = 110; const ATTACH_FUND_COLLECT_BUSINESS_REG_PROXY_AGREEMENT = 111; const ATTACH_FUND_COLLECT_BUSINESS_REG_OTHER = 112; const ATTACH_FUND_COLLECT_BUSINESS_REG_BUSINESS_LICENSE = 113; const ATTACH_FUND_COLLECT_HOSTING_PLAN_AGREEMENT = 121; const ATTACH_FUND_COLLECT_HOSTING_PLAN_OTHER = 122; const ATTACH_FUND_COLLECT_TAX_OTHER = 131; const ATTACH_FUND_COLLECT_FILING_OTHER = 141; const ATTACH_FUND_COLLECT_DELIVERY = 142; const ATTACH_FUND_CHANGE_LOGS = 145; const ATTACH_FUND_MANAGE_BUSINESS_CHANGE = 150; const ATTACH_FUND_MANAGE_TAX_CHANGE = 151; const ATTACH_FUND_MANAGE_FILING_CHANGE = 152; const ATTACH_FUND_MANAGE_REPORT_CHANGE = 153; const ATTACH_FUND_DISPATCH_PARTNERS = 154; const ATTACH_PARTNER = 200; const ATTACH_PROGRESS_LOGS = 250; const ATTACH_INDUSTRY = 300; const ATTACH_NOTES = 500; const ATTACH_KNOWLEDGE = 800; public static $attachTypeDefs = array(3 => array("\x65\x6e\164\151\164\171\137\164\171\x70\145" => Defs::ENTITY_PROJECT, "\154\x61\142\145\x6c" => "\xe5\x95\206\344\xb8\x9a\350\256\241\345\x88\x92\xe4\xb9\xa6"), 4 => array("\x65\156\x74\151\x74\171\x5f\x74\171\x70\x65" => Defs::ENTITY_PROJECT, "\x6c\141\142\x65\154" => "\xe8\xb4\xa2\xe5\x8a\241"), 5 => array("\x65\x6e\164\x69\164\171\137\x74\x79\160\x65" => Defs::ENTITY_PROJECT, "\x6c\141\142\x65\x6c" => "\xe6\xb3\225\345\212\241"), 6 => array("\145\x6e\x74\x69\164\x79\x5f\x74\x79\x70\x65" => Defs::ENTITY_PROJECT, "\154\x61\142\145\x6c" => "\345\xae\xa2\346\210\267\x26\xe4\270\x9a\345\212\xa1"), 7 => array("\x65\x6e\164\x69\x74\171\137\x74\171\160\145" => Defs::ENTITY_PROJECT, "\x6c\x61\142\x65\154" => "\xe4\272\247\345\x93\201\46\xe6\x8a\200\xe6\x9c\xaf"), 8 => array("\x65\156\164\151\x74\x79\x5f\x74\171\160\x65" => Defs::ENTITY_TALENT, "\x6c\141\142\145\154" => "\345\x88\233\xe5\xa7\x8b\344\272\xba\xe9\231\204\344\xbb\266"), 9 => array("\145\156\164\x69\x74\171\137\x74\x79\160\145" => Defs::ENTITY_PROJECT, "\x6c\141\x62\145\x6c" => "\xe6\x8a\225\xe8\xb5\204\345\xbb\xba\350\256\xae\xe4\xb9\246"), 10 => array("\x65\156\x74\x69\164\x79\137\164\171\x70\x65" => Defs::ENTITY_PROJECT, "\x6c\x61\142\x65\154" => "\347\273\xbc\xe5\x90\x88\346\235\220\346\226\231"), 11 => array("\x65\x6e\164\x69\164\x79\x5f\x74\171\x70\145" => Defs::ENTITY_PROJECT, "\154\x61\142\x65\154" => "\346\212\225\xe8\265\x84\xe5\x8d\217\350\xae\xae\xef\274\x88\xe4\272\xa4\345\211\xb2\357\xbc\x89"), 12 => array("\145\x6e\x74\151\164\x79\x5f\x74\171\x70\x65" => Defs::ENTITY_PROJECT, "\x6c\x61\142\145\x6c" => "\350\202\xa1\344\270\x9c\344\274\x9a\xe5\x86\xb3\xe8\256\256\x2d\347\x9b\x96\347\xab\240\xe9\231\204\xe4\xbb\266"), 13 => array("\145\156\x74\151\164\171\x5f\164\171\x70\145" => Defs::ENTITY_PROJECT, "\x6c\141\142\x65\154" => "\xe6\x8a\225\350\265\204\345\215\x8f\xe8\256\256\55\347\x9b\226\xe7\xab\xa0\xe9\x99\204\344\273\266"), 14 => array("\x65\x6e\164\x69\x74\171\137\164\x79\x70\145" => Defs::ENTITY_PROJECT, "\x6c\x61\x62\145\154" => "\346\212\x95\xe5\xa7\x94\xe4\xbc\x9a\xe5\206\xb3\350\256\xae\55\xe7\255\276\xe5\xad\227\351\x99\204\344\xbb\xb6"), 15 => array("\145\x6e\x74\x69\164\171\x5f\x74\171\160\x65" => Defs::ENTITY_PROJECT, "\x6c\141\x62\x65\154" => "\345\220\210\xe8\xa7\204\xe8\xaf\x81\xe6\x98\x8e\55\xe7\233\x96\347\xab\240\351\x99\204\344\273\266"), 16 => array("\x65\156\164\151\x74\171\x5f\164\x79\x70\145" => Defs::ENTITY_PROJECT, "\x6c\141\x62\145\154" => "\350\202\241\344\xb8\x9c\xe6\x94\xbe\345\xbc\x83\344\xbc\x98\345\205\210\350\xb4\xad\xe4\271\xb0\xe6\235\203\55\xe7\255\276\xe5\xad\x97\351\231\204\xe4\273\266"), 17 => array("\x65\156\x74\x69\x74\x79\x5f\x74\171\x70\x65" => Defs::ENTITY_PROJECT, "\x6c\141\142\x65\154" => "\xe6\x89\223\346\254\276\xe8\xb4\246\xe5\x8f\xb7\351\200\x9a\xe7\237\245\55\347\x9b\226\347\xab\240\351\x99\204\344\xbb\xb6"), 18 => array("\145\156\164\151\164\171\137\164\171\160\x65" => Defs::ENTITY_PROJECT, "\154\141\142\145\x6c" => "\xe4\272\244\xe5\211\xb2\xe5\x90\216\xe8\xaf\201\346\230\216"), 19 => array("\x65\156\x74\x69\x74\171\137\x74\171\160\x65" => Defs::ENTITY_PROJECT, "\x6c\141\x62\x65\x6c" => "\xe6\212\225\345\220\x8e\350\xb4\242\xe5\x8a\241\xe6\x8a\245\xe5\x91\212"), 20 => array("\x65\x6e\164\151\x74\171\x5f\164\x79\160\145" => Defs::ENTITY_PROJECT, "\x6c\141\x62\145\154" => "\345\210\222\346\254\276\xe6\x8c\x87\344\xbb\xa4"), 21 => array("\145\x6e\x74\x69\164\x79\137\164\171\x70\145" => Defs::ENTITY_PROJECT, "\x6c\141\x62\x65\154" => "\345\x88\x9b\345\xa7\213\345\x9b\242\351\x98\x9f"), 22 => array("\x65\x6e\x74\151\x74\171\x5f\x74\171\160\x65" => Defs::ENTITY_PROJECT, "\154\141\x62\145\154" => "\xe8\220\245\344\xb8\232\346\211\247\xe7\205\xa7"), self::ATTACH_ENTERPRISE_EXIT_PROTOCOL => array("\x65\156\x74\x69\x74\x79\137\164\171\x70\x65" => Defs::ENTITY_PROJECT, "\154\141\x62\145\154" => "\xe9\200\x80\345\x87\272\345\x8d\x8f\xe8\xae\xae\345\x8f\x8a\xe6\x96\x87\344\xbb\266"), self::ATTACH_ENTERPRISE_EXIT_DELIVERY => array("\145\x6e\x74\x69\x74\171\137\164\x79\x70\x65" => Defs::ENTITY_PROJECT, "\x6c\x61\x62\145\154" => "\344\xba\244\xe5\211\262\xe8\xaf\x81\xe6\x98\216\xe6\x96\207\344\273\266"), 25 => array("\145\156\164\151\x74\171\137\x74\171\160\145" => Defs::ENTITY_PROJECT, "\x6c\x61\x62\x65\x6c" => "\xe6\x8a\x95\350\xb5\x84\350\xbd\xae\xe6\254\xa1\55\xe5\xb0\xbd\xe8\xb0\203\xe8\xb5\204\xe6\226\231"), 26 => array("\x65\x6e\164\151\164\x79\x5f\x74\x79\160\x65" => Defs::ENTITY_PROJECT, "\154\141\x62\x65\154" => "\346\x8a\225\xe8\xb5\204\344\xba\244\xe5\x89\xb2\55\345\x89\215\xe7\275\xae\346\x9d\x90\xe6\226\x99\55\xe5\x85\xb6\xe4\273\x96"), 27 => array("\x65\x6e\x74\x69\x74\171\x5f\x74\x79\160\145" => Defs::ENTITY_PROJECT, "\x6c\x61\142\145\x6c" => "\350\xa1\x8c\344\270\232\xe5\x88\206\xe6\236\220"), 28 => array("\x65\156\x74\x69\164\171\x5f\x74\171\160\145" => Defs::ENTITY_PROJECT, "\x6c\x61\x62\145\154" => "\346\x8a\225\345\x86\xb3\344\274\232\xe8\265\204\346\226\231"), 29 => array("\145\x6e\164\x69\164\x79\137\164\x79\x70\x65" => Defs::ENTITY_COMPANY, "\x6c\x61\142\145\x6c" => "\346\213\233\xe8\x82\xa1\350\xaf\xb4\346\x98\x8e\344\271\xa6"), 30 => array("\x65\156\x74\151\164\x79\137\x74\x79\x70\145" => Defs::ENTITY_COMPANY, "\x6c\141\x62\x65\x6c" => "\347\xa0\x94\347\251\266\xe6\x8a\xa5\xe5\221\x8a"), 31 => array("\x6c\141\x62\145\154" => "\xe8\x82\241\344\270\x9c\350\241\250\55\350\202\xa1\344\xb8\x9c\346\230\x8e\347\273\206"), 32 => array("\154\141\142\145\x6c" => "\346\212\225\xe8\265\x84\345\x8d\217\xe8\256\256\xef\274\210\346\x8a\225\xe8\x9e\x8d\xe8\265\204\357\274\x89"), self::ATTACH_NOTES => array("\154\141\142\145\x6c" => "\xe9\200\232\347\224\250\xe8\256\260\xe5\275\225\xe9\231\204\xe4\273\266\357\xbc\x88\156\157\164\x65\163\350\xa1\250\xef\xbc\x89"), self::ATTACH_FUND_PARTNER_AGREEMENT => array("\145\x6e\164\151\164\171\x5f\x74\171\x70\145" => Defs::ENTITY_FUND, "\x6c\x61\142\145\154" => "\xe5\237\xba\xe9\207\x91\345\220\210\344\274\231\344\xba\xba\345\x8d\217\350\256\xae"), self::ATTACH_FUND_COLLECT_BP => array("\145\x6e\164\151\164\171\x5f\164\x79\160\x65" => Defs::ENTITY_FUND, "\154\141\x62\145\x6c" => "\xe5\x9f\272\351\x87\x91\xe5\x95\206\xe4\270\x9a\xe8\xae\241\345\x88\222\xe4\271\xa6"), self::ATTACH_FUND_FILING_LETTER => array("\x65\x6e\x74\151\x74\171\x5f\164\x79\160\145" => Defs::ENTITY_FUND, "\x6c\x61\142\x65\154" => "\xe5\237\272\351\207\221\xe5\244\207\346\241\x88"), self::ATTACH_FUND_COLLECT_BUSINESS_REG_PROXY_AGREEMENT => array("\x65\x6e\x74\151\x74\171\x5f\164\x79\x70\145" => Defs::ENTITY_FUND, "\x6c\x61\142\145\154" => "\xe5\237\xba\351\x87\x91\xe5\213\237\xe9\x9b\206\xe5\267\245\345\225\206\xe6\xb3\xa8\xe5\x86\x8c\xe4\273\243\xe7\220\x86\345\x8d\217\350\256\256"), self::ATTACH_FUND_COLLECT_BUSINESS_REG_OTHER => array("\145\156\164\151\164\171\137\x74\x79\x70\x65" => Defs::ENTITY_FUND, "\154\x61\142\x65\x6c" => "\xe5\237\xba\351\207\x91\345\x8b\237\351\x9b\206\xe5\xb7\245\345\225\206\xe6\xb3\xa8\xe5\206\214\xe5\205\266\344\273\x96\xe9\231\x84\xe4\xbb\266"), self::ATTACH_FUND_COLLECT_BUSINESS_REG_BUSINESS_LICENSE => array("\x65\156\x74\x69\x74\171\137\164\x79\x70\x65" => Defs::ENTITY_FUND, "\154\141\x62\145\x6c" => "\xe5\x9f\272\351\x87\221\345\xb7\245\345\225\206\xe6\xb3\250\xe5\206\x8c\350\x90\245\344\xb8\232\xe6\211\xa7\347\x85\xa7"), self::ATTACH_FUND_COLLECT_HOSTING_PLAN_AGREEMENT => array("\145\x6e\x74\151\164\x79\x5f\x74\171\160\145" => Defs::ENTITY_FUND, "\x6c\141\142\145\x6c" => "\xe5\237\272\351\207\221\xe5\x8b\x9f\xe9\233\206\xe6\211\230\347\xae\241\xe5\x8d\217\xe8\256\xae"), self::ATTACH_FUND_COLLECT_HOSTING_PLAN_OTHER => array("\145\156\164\151\x74\171\x5f\164\171\160\x65" => Defs::ENTITY_FUND, "\x6c\x61\x62\x65\154" => "\345\x9f\272\351\x87\x91\xe5\x8b\237\351\233\206\xe6\x89\230\xe7\xae\241\345\205\266\344\xbb\x96\351\231\204\xe4\273\xb6"), self::ATTACH_FUND_COLLECT_TAX_OTHER => array("\x65\x6e\x74\x69\164\171\x5f\x74\171\160\145" => Defs::ENTITY_FUND, "\154\141\x62\x65\x6c" => "\xe5\237\xba\xe9\207\x91\xe7\250\216\xe5\212\241\351\231\x84\xe4\xbb\xb6"), self::ATTACH_FUND_COLLECT_FILING_OTHER => array("\x65\x6e\x74\x69\x74\171\x5f\x74\171\x70\x65" => Defs::ENTITY_FUND, "\x6c\141\142\145\154" => "\xe5\x9f\272\351\x87\221\345\xa4\207\346\241\210\xe5\205\xb6\344\273\x96\xe9\x99\x84\xe4\xbb\xb6"), self::ATTACH_FUND_COLLECT_DELIVERY => array("\145\x6e\164\151\x74\171\x5f\x74\x79\160\x65" => Defs::ENTITY_FUND, "\154\141\x62\145\154" => "\xe5\237\272\xe9\x87\x91\xe4\xba\244\xe5\211\xb2\xe9\x99\204\xe4\273\xb6"), self::ATTACH_FUND_CHANGE_LOGS => array("\145\156\x74\151\164\x79\137\164\x79\160\145" => Defs::ENTITY_FUND, "\154\x61\142\145\x6c" => "\xe5\237\xba\351\x87\221\346\x97\xa5\xe5\xb8\xb8\347\273\xb4\346\x8a\244\xe9\231\x84\344\xbb\xb6"), self::ATTACH_FUND_MANAGE_BUSINESS_CHANGE => array("\145\156\x74\x69\164\x79\x5f\164\171\x70\x65" => Defs::ENTITY_FUND, "\154\141\x62\145\154" => "\xe5\237\xba\351\x87\221\347\256\241\347\220\x86\345\xb7\245\345\x95\206\345\217\230\346\233\xb4\xe9\231\x84\xe4\273\266"), self::ATTACH_FUND_MANAGE_TAX_CHANGE => array("\145\x6e\164\x69\x74\x79\137\164\171\x70\x65" => Defs::ENTITY_FUND, "\154\x61\x62\x65\x6c" => "\345\237\272\351\x87\x91\347\256\241\347\220\206\xe7\xa8\216\345\x8a\241\xe9\x99\x84\344\xbb\266"), self::ATTACH_FUND_MANAGE_FILING_CHANGE => array("\145\156\164\151\x74\171\137\164\171\x70\145" => Defs::ENTITY_FUND, "\x6c\141\x62\x65\x6c" => "\xe5\237\272\xe9\207\221\345\xa4\207\xe6\xa1\210\347\273\xb4\xe6\x8a\xa4\xe9\231\204\xe4\273\266"), self::ATTACH_FUND_MANAGE_REPORT_CHANGE => array("\x65\156\164\x69\x74\x79\x5f\x74\x79\x70\x65" => Defs::ENTITY_FUND, "\154\x61\142\145\x6c" => "\345\237\272\351\x87\x91\xe5\271\264\xe5\272\246\xe6\212\245\xe5\221\212\351\231\204\344\xbb\266"), self::ATTACH_FUND_DISPATCH_PARTNERS => array("\145\156\x74\151\164\x79\x5f\x74\x79\x70\x65" => Defs::ENTITY_FUND, "\x6c\x61\x62\145\x6c" => "\345\x9f\272\xe9\207\221\xe9\xa1\xb9\347\x9b\xae\351\x80\200\345\x87\272\xe6\224\266\347\x9b\x8a\345\210\206\351\205\215\xe9\x99\204\xe4\273\266"), self::ATTACH_PARTNER => array("\x65\156\164\151\164\171\x5f\164\x79\160\x65" => Defs::ENTITY_PARTNER, "\154\141\x62\x65\x6c" => "\xe5\237\xba\351\207\x91\xe5\x90\210\344\274\231\xe4\xba\xba\351\x99\x84\344\xbb\xb6"), self::ATTACH_INDUSTRY => array("\145\156\x74\x69\164\171\137\164\x79\160\x65" => Defs::ENTITY_INDUSTRY, "\x6c\x61\x62\145\x6c" => "\xe8\241\x8c\xe7\240\x94\xe6\212\245\345\221\212"), self::ATTACH_KNOWLEDGE => array("\145\156\x74\151\x74\171\x5f\x74\171\x70\145" => Defs::ENTITY_KNOWLEDGE, "\154\141\x62\145\154" => "\346\231\xba\xe5\272\x93\346\226\207\347\xab\xa0")); public static $attachFileTypeDefs = array("\152\160\x65\x67" => array("\154\x61\142\x65\154" => "\xe5\233\276\xe7\211\x87", "\x69\x63\x6f\156" => "\x66\x61\x20\x66\141\55\x66\151\154\x65\x2d\151\x6d\141\x67\145\x2d\x6f"), "\160\156\x67" => array("\x6c\x61\x62\145\x6c" => "\xe5\x9b\xbe\347\211\207", "\151\x63\x6f\x6e" => "\146\141\40\146\x61\55\x66\x69\154\x65\55\151\x6d\141\x67\145\55\x6f"), "\152\x70\147" => array("\154\141\x62\x65\x6c" => "\xe5\x9b\xbe\347\211\x87", "\x69\x63\x6f\x6e" => "\146\141\x20\x66\141\x2d\x66\151\154\x65\55\151\155\141\147\x65\55\x6f"), "\x67\151\146" => array("\x6c\141\x62\145\x6c" => "\xe5\x9b\xbe\xe7\211\207", "\151\143\157\x6e" => "\x66\141\x20\x66\x61\x2d\x66\x69\154\145\x2d\151\x6d\x61\x67\x65\55\157"), "\x64\157\143" => array("\x6c\x61\x62\x65\x6c" => "\127\157\x72\144\xe6\226\x87\346\241\243", "\151\143\x6f\156" => "\146\x61\x20\x66\x61\x2d\x66\151\x6c\145\x2d\x77\x6f\x72\x64\55\157"), "\x64\x6f\143\x78" => array("\154\x61\142\145\154" => "\x57\157\162\x64\xe6\226\x87\346\241\243", "\x69\143\x6f\156" => "\146\141\x20\146\141\55\x66\x69\154\145\x2d\x77\157\162\x64\x2d\x6f"), "\170\154\x73" => array("\x6c\141\142\x65\x6c" => "\x45\x78\x63\145\x6c\350\xa1\xa8\346\xa0\xbc", "\151\143\157\156" => "\x66\x61\40\146\x61\55\146\151\154\145\55\145\170\x63\x65\x6c\55\157"), "\x78\154\163\170" => array("\154\x61\142\145\154" => "\x45\x78\x63\x65\154\350\241\xa8\xe6\240\xbc", "\151\143\157\156" => "\146\x61\40\x66\x61\55\x66\151\x6c\x65\55\145\x78\x63\145\154\55\157"), "\160\160\164" => array("\x6c\141\x62\x65\x6c" => "\xe5\xb9\273\xe7\201\xaf\347\211\207", "\x69\x63\x6f\x6e" => "\x66\141\x20\146\x61\55\x66\151\154\145\55\160\157\167\x65\162\160\157\x69\x6e\x74\x2d\x6f"), "\160\160\164\170" => array("\154\141\142\145\154" => "\345\xb9\273\347\201\xaf\xe7\211\x87", "\x69\143\x6f\156" => "\146\141\x20\x66\x61\55\x66\x69\154\x65\55\160\157\167\x65\162\160\157\x69\x6e\164\x2d\x6f"), "\160\x64\x66" => array("\x6c\141\142\x65\154" => "\x50\104\x46\346\x96\207\346\241\243", "\x69\x63\157\x6e" => "\146\x61\40\x66\141\55\x66\151\x6c\145\55\160\144\x66\x2d\x6f"), "\164\x78\x74" => array("\x6c\x61\142\x65\x6c" => "\xe6\x96\207\346\x9c\254\xe6\226\x87\xe6\241\243", "\x69\143\157\156" => "\146\141\x20\x66\141\55\146\151\154\145\55\164\x65\170\164"), "\172\151\160" => array("\x6c\141\x62\145\154" => "\xe5\216\213\xe7\274\251\346\226\207\346\241\243", "\151\143\x6f\156" => "\146\x61\40\x66\141\x2d\x66\x69\154\145\55\x61\x72\143\150\x69\166\145\x2d\x6f"), "\162\141\x72" => array("\x6c\141\x62\145\x6c" => "\345\x8e\213\347\274\xa9\xe6\226\207\xe6\241\xa3", "\x69\x63\157\156" => "\146\x61\40\146\x61\55\146\151\154\x65\55\x61\162\x63\150\x69\x76\145\55\x6f")); protected function __construct() { parent::__construct(); } public function insertAttach($originalName, $saveName, $mimeType, $fileSize, $description, $attachmentType, $externalId, $externalId2 = 0, $attachmentCategoryId = 0, $src = CommonDefs::MODULE_ADMIN, $pid = 0) { goto DfXzf; yvQGX: $attachmentId = $attachmentsModel->attachment_id; goto lp6x8; lp6x8: Log::notice("\164\150\145\x20\156\x65\x77\x20\141\164\164\x61\x63\150\155\x65\x6e\x74\40\151\x64\72\x20" . $attachmentId); goto isExy; QN5iG: b1x1L: goto z38Gi; dB0RD: $attachmentsModel->save(); goto yvQGX; z38Gi: DkSlx: goto dB0RD; BZAIJ: switch ($src) { case 0: case CommonDefs::MODULE_ADMIN: goto TsHmr; mMsDG: $attachmentsModel["\x75\163\x65\162\x5f\x74\x79\x70\x65"] = CommonDefs::MODULE_ADMIN; goto dJIRl; TsHmr: $attachmentsModel["\x75\163\x65\162\137\151\x64"] = \app\index\service\RequestContext::I()->loginUserId; goto mMsDG; dJIRl: goto DkSlx; goto gCJ4F; gCJ4F: case CommonDefs::MODULE_PROJECT: goto gPy_J; mH4AR: $attachmentsModel["\165\x73\145\162\137\x74\x79\160\x65"] = $src; goto qOf2F; qOf2F: goto DkSlx; goto HFLqx; gPy_J: $p_user = \app\p\service\User::I()->getLoginUser(); goto rgKpU; rgKpU: $attachmentsModel["\165\x73\x65\162\137\x69\144"] = intval($p_user["\151\x64"]); goto mH4AR; HFLqx: } goto QN5iG; isExy: return $attachmentId; goto QIOg2; bOAj8: $attachmentsModel->data(["\157\x72\151\x67\151\156\x61\154\137\x6e\141\x6d\145" => $originalName, "\x73\141\x76\145\x5f\x6e\x61\155\145" => $saveName, "\x6d\x69\x6d\145\x5f\x74\x79\160\145" => $mimeType, "\144\x65\x73\143\162\x69\160\164\151\157\x6e" => $description, "\163\151\x7a\145" => $fileSize, "\141\164\x74\x61\x63\150\155\x65\x6e\x74\x5f\x74\x79\160\145" => $attachmentType, "\x65\x78\x74\x65\162\156\141\154\x5f\151\x64" => $externalId, "\145\170\x74\x65\x72\156\x61\x6c\x5f\x69\144\62" => intval($externalId2), "\160\151\144" => $pid, "\141\164\x74\141\143\150\155\x65\156\x74\x5f\x63\141\x74\145\147\x6f\x72\171\137\x69\144" => $attachmentCategoryId, "\145\156\x74\x65\162\x65\x64" => Db::raw("\x6e\x6f\167\x28\x29")]); goto BZAIJ; DfXzf: $attachmentsModel = new Attachments(); goto bOAj8; QIOg2: } public function getAttaches($attachmentType, $externalId, $externalId2 = 0, $src = CommonDefs::MODULE_ADMIN) { goto xUwnX; JDIBb: return []; goto HT9kE; nbd1c: $p_user = \app\p\service\User::I()->getLoginUser(); goto utaJc; d2GU4: if (!($src == CommonDefs::MODULE_PROJECT)) { goto Nqk_H; } goto nbd1c; Br806: $conditions["\165\163\145\x72\x5f\x74\171\160\x65"] = $src; goto SCZyu; I_Hfh: return $attaches; goto Wx1cY; HT9kE: CVvvH: goto GQhyb; GQhyb: $conditions = ["\x61\164\164\141\x63\150\155\145\156\x74\x5f\164\171\160\145" => $attachmentType, "\x65\170\164\145\x72\156\x61\x6c\x5f\151\144" => $externalId, "\163\164\141\x74\165\163" => Defs::ATTACHMENT_OK]; goto uxv2w; uxv2w: if (!$externalId2) { goto TMDQK; } goto ZYuzD; SNB6E: TMDQK: goto d2GU4; utaJc: $conditions["\x75\x73\145\162\137\151\144"] = intval($p_user["\151\144"]); goto Br806; xUwnX: if (!empty($externalId)) { goto CVvvH; } goto JDIBb; syWXy: $attaches = Db::table("\x61\164\164\x61\x63\x68\x6d\145\x6e\x74\x73")->where($conditions)->field("\141\x74\164\141\x63\x68\155\145\x6e\x74\x5f\151\x64\54\xd\12\x20\x20\x20\40\x20\x20\40\x20\x20\x20\40\x20\x70\151\144\54\xd\xa\x20\40\x20\40\40\40\40\x20\x20\40\40\x20\x6f\x72\x69\x67\x69\156\141\x6c\x5f\x6e\x61\155\x65\54\15\12\11\x9\x9\x73\x61\166\145\137\x6e\141\x6d\x65\x2c\15\xa\x9\11\x9\155\151\x6d\x65\137\x74\x79\x70\x65\x2c\xd\xa\x9\11\x9\x64\145\x73\x63\162\x69\160\164\x69\x6f\x6e\54\xd\12\x9\11\x9\x73\151\x7a\x65\54\xd\xa\x9\11\11\x61\x74\164\x61\x63\150\x6d\x65\156\x74\x5f\x74\x79\x70\x65\54\xd\12\x9\x9\x9\x65\x78\164\x65\162\156\x61\x6c\x5f\151\x64\x2c\15\12\11\11\x9\x65\x78\x74\145\162\156\x61\154\x5f\151\144\x32\x2c\15\12\x9\x9\11\x61\164\x74\x61\143\150\x6d\145\x6e\x74\137\x63\141\x74\x65\x67\x6f\x72\x79\x5f\151\x64\x2c\xd\xa\11\x9\11\x65\156\x74\145\162\x65\x64\54\15\xa\x9\x9\11\x75\x73\x65\x72\137\x69\144\54\xd\xa\11\11\x9\165\x73\x65\x72\x5f\x74\171\160\145")->order("\x61\x74\x74\141\143\x68\155\x65\x6e\x74\137\x69\x64", "\144\145\x73\143")->select(); goto I_Hfh; SCZyu: Nqk_H: goto syWXy; ZYuzD: $conditions["\x65\170\164\x65\x72\x6e\141\x6c\137\x69\144\x32"] = $externalId2; goto SNB6E; Wx1cY: } public function deleteAttach($attachmentId) { goto udH73; jz2co: $where["\141\x74\x74\141\143\x68\x6d\145\x6e\164\x5f\151\x64"] = count($attachmentId) > 1 ? ["\151\156", $attachmentId] : $attachmentId[0]; goto u6v2W; gwg1R: return true; goto R9uvU; QbHEL: DNSNQ: goto jz2co; udH73: if (!($attachmentId && !is_array($attachmentId))) { goto DNSNQ; } goto dD_BN; dD_BN: $attachmentId = explode("\54", $attachmentId); goto QbHEL; u6v2W: Attachments::where($where)->setField("\163\x74\x61\x74\x75\x73", Defs::ATTACHMENT_DEL); goto gwg1R; R9uvU: } public function deleteAttaches($externalId, $attachmentType) { Db::table("\141\164\x74\x61\143\x68\x6d\x65\x6e\x74\163")->where(["\x61\164\x74\x61\143\x68\x6d\145\x6e\x74\137\164\x79\160\145" => $attachmentType, "\x65\x78\x74\x65\162\x6e\x61\x6c\137\x69\144" => $externalId, "\163\x74\141\x74\165\x73" => Defs::ATTACHMENT_OK])->setField("\163\164\141\x74\165\x73", Defs::ATTACHMENT_DEL); return true; } public function relateAttaches($attachment_id, $external_id, $external_id2 = 0) { goto xeSUt; d2Q0a: if (!$external_id2) { goto cnEJn; } goto f8Ecx; N7HBi: $save["\145\x78\164\x65\162\x6e\x61\x6c\x5f\x69\x64"] = $external_id; goto d2Q0a; xeSUt: if (!empty($attachment_id)) { goto ZPu8x; } goto hgyiL; QKaJV: mRoYU: goto N7HBi; f8Ecx: $save["\x65\x78\164\x65\x72\x6e\x61\154\137\x69\144\62"] = $external_id2; goto oaSvn; ZAPSi: if (is_array($attachment_id)) { goto mRoYU; } goto Q5MIb; hgyiL: return; goto p0Arg; Q5MIb: $attachment_id = explode("\54", $attachment_id); goto QKaJV; oaSvn: cnEJn: goto sbtMb; p0Arg: ZPu8x: goto ZAPSi; sbtMb: Db::table("\x61\x74\x74\141\143\x68\x6d\145\x6e\164\163")->where(["\x61\x74\164\141\143\150\x6d\x65\x6e\164\x5f\151\144" => isset($attachment_id[1]) ? ["\151\156", $attachment_id] : $attachment_id[0]])->update($save); goto Drldv; Drldv: } }