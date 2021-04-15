<?php

namespace app\core\driver\sms\package\aliyun;

class ErrorCode
{
    public static $data = [
        'JL:0002' => '手机号异常，建议确认手机号是否正常',
        'JL:0012' => '扩展号超长，建议修改扩展号',
        'JL:0013' => '手机号在账号黑名单中，建议解除手机号黑名单',
        'JL:0014' => '短信内容中有违禁词，建议修改短信内容',
        'JL:0015' => '帐号余额不足，建议进行账户充值',
        'JL:0016' => '帐号日发送上限，建议24小时后发送',
        'JL:0017' => '通道未配置，建议反馈进行业务配置',
        'JL:0018' => '短信提交超速，建议降低短信提交流速',
        'JL:0019' => '余额查询超速，建议降低余额查询频次',
        'JL:0020' => '状态报告主动查询超速，建议降低状态报告主动查询频次',
        'JL:0021' => '群发限制，建议减少群发数量',
        'JL:0022' => '短信签名未备案，建议进行短信签名备案',
        'JL:0023' => '短信签名未设置或设置错误，建议设置短信签名',
        'JL:0024' => '关键字或群发审核未通过，建议修改短信内容',
        'JL:0025' => '单个号码日发送上限，建议24小时后发送',
        'JL:0026' => '手机号在平台黑名单中，建议联系平台解除黑名单',
        'DELIVERED' => '',
        'BLACK' => '普通黑名单，建议联系平台解除黑名单',
        'REJECTD' => '驳回，建议修改短信内容',
        'UNDELIV' => '失败，建议联系平台核查原因',
        'E:CHAN' => '无通道（不符合规范手机号），建议联系平台确认原因',
        'E:ODSL' => '号码超秒限，建议1秒后再发送',
        'E:ODDL' => '号码超日限，建议24小时后发送',
        'E:ODWL' => '号码超周限，建议7天后发送',
        'E:ODML' => '号码超月限，建议30天后发送',
        'E:DISPR' => '屏蔽省份，建议联系运营商解决',
        'E:SIGN' => '签名错，建议更换签名',
        'E:EXT' => '扩展错，建议使用正确的扩展号',
        'E:APP' => '无账户，建议使用正确的账户',
        'E:PROD' => '无产品，建议反馈进行业务配置',
        'MBBLACK' => '黑名单，建议联系平台进行黑名单解除',
        'KEYWORD' => '关键字屏蔽，建议修改短信内容',
        'NOPASS' => '人工驳回，建议修改短信内容',
        'SUBFAIL' => '提交网关失败，建议联系平台核查原因',
        'SIGFAIL' => '签名未报备，建议进行签名报备',
        'BEYONDN' => '超过次数控制，建议减少发送次数',
        'tuiding' => '已退订，建议联系用户取消退订',
        'NOTITLE' => '无退订',
        'W-BLACK' => '验证码的专属黑名单，建议联系平台解除黑名单',
        'S:111' => '提交速度过快，建议降低提交速度',
        'SJ:9441' => '同一个号码发送频次为：2天1次，建议降低发送频次',
        'Z:-7' => '10658139内容关键词原因拦截，建议修改短信内容',
        'YX:0019' => '122黑名单，建议联系平台解除黑名单',
        'YX:9403' => '黑名单，建议联系平台解除黑名单',
        'YX:9413' => '10秒以内同内容同号码重复发送2次以上，建议10秒后再发送',
        'YX:9415' => '会员营销：因内容有敏感字而拒绝发送，建议修改短信内容',
        'YX:9430' => '会员营销：长短信提交不完整，建议检查是否符合长短信格式',
        'YX:9431' => '会员营销：签名被屏蔽，建议更换发送签名',
        'YX:9501' => '会员营销：手机号码错误，建议确认发送的手机号码',
        'AP:10' => '错误的原发号码，建议联系平台核查原因',
        'AP:12' => '错误的目的号码，建议联系平台核查原因',
        'AP:15' => '错误的资费代码，建议联系平台核查原因',
        'AP:16' => '该时间段内禁止下发',
        'AP:17' => '签名无效，建议进行签名备案',
        'AP:2' => 'IP鉴权错误，建议联系平台核查原因',
        'AP:3' => '鉴权错误，建议联系平台核查原因',
        'AP:4' => '版本号错误，建议联系平台确认版本号',
        'AP:5' => '错误的资费代码，建议联系平台核查原因',
        'AP:6' => '错误的消息长度，建议修改消息长度',
        'AP:7' => '错误的服务代码，建议使用正确的服务代码',
        'AP:8' => '提交超流量，建议降低提交流量',
        'AP:9' => '错误的MSG_FORMAT，建议联系平台核查原因',
        'CNN:1' => '错误的消息包，建议使用正确的消息包',
        'CNN:100' => '内部错误，建议联系平台核查原因',
        'CNN:15' => '错误的资费代码，建议联系平台核查原因',
        'CNN:2' => 'IP错误，建议使用正确的IP',
        'CNN:21' => '连接过多，建议减少连接数',
        'CNN:3' => '验证错误，建议核对账号密码',
        'CNN:4' => '版本号错误，建议使用正确的版本号',
        'CNN:5' => '其他错误，建议联系平台核查原因',
        'CNN:6' => '错误的接入点，建议使用正确的接入点',
        'CNN:7' => '错误的状态，建议联系平台核查原因',
        'CL26:1' => '关机，建议联系用户开机',
        'CL26:-13' => '10658139网关黑名单，建议用户回复1111至1065813911111可直接解除',
        'CL26:-15' => '同1个号码半个小时内只能下发2条短信，建议半小时后发送',
        'CL26:-35' => '同号码30分钟内同时注册两个以上不同签名，建议30分钟后注册签名',
        'CL26:-36' => '因网站无图形验证，建议添加图形验证后联系平台解除拦截',
        'CL26:-37' => '同一个号码一天10条限制，建议减少发送条数',
        'CL26:-99' => '10658提交超时，建议减少提交量',
        'CL31RESP:5' => '142移动运营商错误，建议联系平台核查原因',
        'NOROUTE' => '无通道，建议联系平台核查原因',
        'ROUTEERR' => '通道异常，建议联系平台核查原因',
        'REJECT' => '审核驳回，建议修改短信内容',
        'DISTURB' => '手机号码发送次数过多，建议减少发送次数',
        'EMSERR' => '长短信不完整，建议修改长短信格式',
        'SIGNERR' => '签名错误，建议使用正确的签名',
        '2_1' => '空号，建议使用正确的手机号',
        '2_10' => '用户欠费停机',
        '2_12' => '不在服务区',
        '2_13' => '用户欠费停机',
        '2_24' => '关机',
        '2_3' => '关机',
        '2_5' => '用户欠费停机',
        '2_56' => '某些字符无法识别，建议修改短信内容',
        '2_59' => '关机',
        '2_64' => '发送的号码有问题',
        '2_67' => '黑名单，建议联系平台解除黑名单',
        '2_86' => '黑名单，建议联系平台解除黑名单',
        'S:1' => '黑名单，建议联系平台解除黑名单',
        'S:3' => '黑名单，建议联系平台解除黑名单',
        'S:4' => '网关未分配通道，建议联系平台核查原因',
        'S:5' => '号码格式错误，建议使用正确的号码',
        'S:6' => '签名提交错误，建议重新提交签名',
        'S:7' => '用户名密码错误，建议提交正确的用户名密码',
        'S:8' => '超速，建议降低提交速率',
        'S:11' => '预付费用户欠费，建议进行账户充值',
        'S:13' => '是发送的包里号码放的太多了，建议减少发送的号码',
        'S:15' => '超过发送限制，1分钟5条1小时10条超过会返回S15的错误代码，建议减少单号码发送数量',
        'YX:9402' => '平台自定义错误代码：非法内容，建议修改短信内容',
        'YX:9416' => '平台自定义错误代码：系统审核，建议修改短信内容',
        'YX:9417' => '平台自定义错误代码：夜间模版审核，建议白天进行模版审核',
        'YX:9419' => '非验证码内容一天超过10次被系统屏蔽，建议减少发送数量',
        'YX:9420' => '平台自定义错误代码：夜间，建议白天进行业务发送',
        'YX:9421' => '平台自定义错误代码：夜间，建议白天进行业务发送',
        'YX:9422' => '平台自定义错误代码：人工二次审核，建议修改短信内容',
        'YX:9423' => '平台自定义错误代码：高危审核，建议修改短信内容',
        'YX:9424' => '夜间系统审核因非法字符，建议修改短信内容',
        'YX:9425' => '系统判断多签名而自动拒绝发送，建议只使用一个签名',
        'YX:9426' => '平台自定义错误代码：营销系统未报备，建议报备营销模版',
        'YX:9427' => '平台自定义错误代码：特级高危内容，建议修改短信内容',
        'YX:9428' => '短信内容为空系统自动拒绝发送，建议修改短信内容',
        'YX:9429' => '平台自定义错误代码：签名超过长度，建议修改签名',
        'YX:9432' => '整个平台验证码1分钟最多发1条，建议1分钟最多发送1条',
        'YX:9433' => '整个平台验证码1小时最多发3条，建议1小时最多发3条',
        'YX:9434' => '整个平台验证码1天最多可发6条，建议1天最多发6条验证码',
        'YX:9909' => '平台自定义错误代码：本网关提交到移动失败，建议联系平台核查原因',
        'M2:0006' => '短信超长，建议修改短信内容',
        'M2:0013' => '非法号码，建议使用正确的手机号码',
        'M2:0042' => '关键字拦截，建议修改短信内容',
        'M2:0043' => '30秒内重发拦截，建议30秒后重新发送',
        'M2:0044' => '空内容，建议修改内容',
        'M2:0045' => '黑名单，建议联系平台解除黑名单',
        'YX:1000' => '超频，建议降低发送频次',
        'YX:1002' => 'CMPP协议应答超时，建议联系平台核查原因',
        'YX:1003' => 'SGIP协议应答超时，建议联系平台核查原因',
        'YX:1004' => 'SMGP协议应答超时，建议联系平台核查原因',
        'YX:1005' => 'smpp协议应答超时，建议联系平台核查原因',
        'YX:1006' => '关键字超频，建议修改短信内容',
        'YX:4002' => 'reback处理超时，建议联系平台核查原因',
        'YX:5001' => 'IP地址解析错误，建议联系平台核查原因',
        'YX:5004' => '审核模块返回码不为200，建议修改审核模版',
        'YX:5005' => '超频计费失败，建议联系平台核查原因',
        'YX:5006' => '计费失败，建议联系平台核查原因',
        'YX:5007' => '短信需要审核时，建议联系平台核查原因',
        'YX:5008' => '发送到audit模块应答超时，建议联系平台核查原因',
        'YX:5009' => '预付费，建议进行账户充值',
        'YX:5010' => '超频扣费模块返回超时，建议联系平台核查原因',
        'YX:7000' => '审核不通过，建议修改文案',
        'YX:8006' => '比如账号注册时为cmpp账号，建议联系平台核查原因',
        'YX:8007' => '电话号码格式错误，建议修改使用正确的号码',
        'YX:8008' => '电话号码在系统黑名单内，建议联系平台解除黑名单',
        'YX:8009' => '重复的号码，建议删除重复号码',
        'YX:8011' => '账号被锁定，建议联系平台解除账号锁定',
        'YX:8012' => '短信内容过长，建议修改短信内容',
        'YX:8013' => '电话号码数量大于100，建议减少号码数量',
        'YX:8014' => '长短信的子短信数量过多，建议减少长短信的子短信数量',
        'YX:8015' => '长短信某个子短信的编号大于子短信总个数，建议修改长短信格式',
        'YX:8016' => '长短信的子短信没有收齐，建议确认长短信是否发送完全',
        'YX:8017' => '长短信拼接超时，建议确认长短信格式',
        'YX:8018' => '内容为空，建议修改短信内容',
        'YX:8019' => '包含关键字，建议修改短信内容',
        'YX:9000' => 'hostip线程返回应答，建议联系平台核查原因',
        'YX:9001' => '电话号码不在配置号段的表中，建议使用争取的号码',
        'YX:9002' => 'clientid错误，建议联系平台核查原因',
        'YX:9003' => 't_sms_client_tariff表空，建议联系平台核查原因',
        'YX:9004' => '选不到合适的通道组，建议联系平台核查原因',
        'YX:9005' => '选不到通道时将消息重新丢回队列，建议联系平台核查原因',
        'YX:9006' => '选不到通道，建议联系平台核查原因',
        'YX:9007' => 't_sms_tariff表空，建议联系平台核查原因',
        'YX:9008' => '计费模块返回应答，建议联系平台核查原因',
        'YX:9009' => '超频计费情况下，建议联系平台核查原因',
        'YX:9010' => 'send模块的节点数，建议联系平台核查原因',
        'YX:9011' => 'IP地址解析错误，建议联系平台核查原因',
        'YX:9013' => '未知的类型的超时，建议联系平台核查原因',
        'YX:9014' => '类对象初始化失败，建议联系平台核查原因',
        'YX:9015' => 'smsp_c2s组件mq队列配置错误，建议联系平台核查原因',
        'YX:4015' => '通道信息表更新，建议联系平台核查原因',
        'YX:4016' => '四大直连协议连接异常，建议联系平台核查原因',
        'YX:4017' => '通道信息表更新，建议联系平台核查原因',
        'YX:4018' => '通道信息表更新，建议联系平台核查原因',
        'YX:4019' => '通道信息表更新，建议联系平台核查原因',
        'YX:5002' => '类对象初始化失败，建议联系平台核查原因',
        'YX:5003' => '类对象初始化失败，建议联系平台核查原因',
        'YX:8023' => '用户使用签名端口，建议报备签名',
        'AP:0' => '',
        'CNN:0' => '',
        'HD:20' => '无发送通道，建议联系平台核查原因',
        'HD:21' => '十分钟重发拦截，建议十分钟后再发送',
        'HD:22' => '危险短信，建议修改短信内容',
        'HD:23' => '未报备的签名，建议报备签名',
        'HD:24' => '此时间段内同一内容的短信数量超出限制，建议减少相同内容短信发送数量',
        'HD:28' => '子码屏蔽，建议联系平台核查原因',
        'HD:31' => '相同验证码发送超限，建议减少验证码发送数量',
        'GL:0000' => '同一个号码下发频次限制。，建议减少同号码下发频次',
        'td:88' => '用户主动回复退订，建议终端用户联系平台取消退订',
        'R1:0210' => '模版未加退订，建议模版增加“回复T退订”',
        'M2:0046' => '单日给同一号码发送超限，建议减少对同一号码单日发送量',
        'E:ODDL:' => '单日给同一号码发送超限，建议减少对同一号码单日发送量',
        'JL:0028' => '终端手机号由于投诉等被列入黑名单',
        'MC_T:901' => '客户未开通国际短信，建议用户开通国际短信',
        'NOWAY' => '未匹配通道，建议联系客服人员进行问题排查',
        'CHECK' => '审核不通过，建议修改文案后重新提交',
        'SIGN' => '签名错误，建议修改签名',
        'LIMIT' => '超发限制，建议降低发送频率',
        'PHONERR' => '无归属地，建议检查号码是否正确',
        'SWITCH' => '通道切出，建议联系客服人员进行问题排查',
        'ERROR' => '提交异常，建议联系客服人员进行问题排查',
        'PKE:024' => '签名有前后各1个，建议修改文案内容',
        'PKE:026' => '被叫长度错误，建议检查号码是否正确',
        'PKE:027' => '被叫是黑名单，建议联系客服人员进行黑名单解除',
        'isv.DOMEST' => '国际短信业务模版不支持针对国内号码发送，建议更换国内短信模版进行短信发送',
        'VALVE:MC_T' => '成本中心条数限制，建议降低发送频率',
        'GX:0003' => '人工驳回，建议修改文案内容',
        'GX:0004' => '签名不规范，建议更换签名',
        'GX:0005' => '验证码超限，建议降低发送频率',
        'GX:0006' => '低于起发限制，建议增加单文案发送量',
        'GX:0007' => '黑签名，建议更换签名',
        'GX:0008' => '黑词，建议修改文案内容',
        'GX:1001' => '黑名单，建议联系客服人员进行黑名单解除',
        'GX:1002' => '退订组，建议终端用户取消退订',
        'GX:1003' => '重复号码，建议核查终端号码是否重复',
        'GX:1004' => '无法识别的号码，建议核查终端号码是否正确',
        'GX:1005' => '号码无发送通道，建议联系客服人员进行问题排查',
        'GX:1006' => '通道异常，建议联系客服人员进行问题排查',
        'GX:1007' => '运营商发送失败，建议联系客服人员进行问题排查',
        'GX:1009' => '通道未启动，建议联系客服人员进行问题排查',
        'GX:1100' => '无报备通道，建议联系客服人员进行问题排查',
        'GX:1101' => '无移动备用通道，建议联系客服人员进行问题排查',
        'GX:1102' => '无移动验证码通道，建议联系客服人员进行问题排查',
        'GX:1103' => '退订组，建议终端用户取消退订',
        'GX:1104' => '黑名单（投诉号码），建议联系客服人员进行黑名单解除',
        'GX:1105' => '长短信内容不全，建议核查短信内容',
        'GX:1106' => '发送失败，建议联系客服人员进行问题排查',
        '-3' => '超频，建议降低发送频率',
        '-2' => '超时，建议联系客服人员进行问题排查',
        '-4' => '余额不足，建议联系客服人员进行问题排查',
        '-6' => '二进制超长，建议联系客服人员进行问题排查',
        'NR-FAIL' => '人工审核返回失败，建议修改文案内容',
        'DIGIT_BUSI' => '业务校验失败，建议联系客服人员进行问题排查',
        'GB:0001' => '分钟级流控，建议降低发送频率',
        'GB:0002' => '小时级流控，建议降低发送频率',
        'GB:0003' => '天级流控，建议降低发送频率',
        'GB:0004' => '签名不合规，建议更换签名',
        'GB:0005' => '签名黑名单，建议更换签名',
        'GB:0006' => '号码无效，建议检查号码是否正确',
        'GB:0007' => '无通道路由，建议联系客服人员进行问题排查',
        'GB:0008' => '用户退订，建议终端用户联系平台取消退订',
        'GB:0009' => '长短信拼接失败，建议检查长短信格式',
        'GB:0010' => '关键字拦截，建议修改文案后重新提交',
        'GB:0011' => '号码黑名单，建议联系客服人员进行黑名单解除',
        'GB:0012' => '人工驳回，建议修改文案后重新提交',
        'GB:0013' => '模版错误，建议更换正确的模版',
        'GB:0014' => '用户欠费，建议用户充值或开通服务重试',
        'GB:0015' => '获取运营商出错，建议检查号码是否正确',
        'MH:0008' => '人工审核失败，建议修改文案后重新提交',
        'MH:0006' => '签名不合法，建议更换签名',
        'MH:0007' => '敏感词拦截，建议修改文案后重新提交',
        'mc:vendor' => '获取运营商出错，建议检查号码是否正确',
        'MC_ZY:559' => '发送的号码所在运营商找不到对应通道，建议检查号码是否正确',
        'M2:0051' => '关键字拦截，建议修改文案后重新提交',
        'isp.RAM_PE' => 'RAM权限DENY，建议联系平台核查原因',
        'isv.OUT_OF' => '业务停机，建议联系平台核查原因',
        'isv.PRODUC' => '未开通云通信产品的阿里云客户，建议开通云通信产品',
        'isv.ACCOUN' => '账户不存在，建议开通账户',
        'isv.SMS_TE' => '短信模版不合法，建议重新申请模版',
        'isv.SMS_SI' => '短信签名不合法，建议重新申请签名',
        'isv.INVALI' => '参数异常，建议使用正确的参数',
        'isp.SYSTEM' => '系统错误，建议联系平台核查原因',
        'isv.MOBILE' => '非法手机号，建议使用正确的手机号',
        'isv.TEMPLA' => '模版缺少变量，建议修改模版',
        'isv.BUSINE' => '业务限流，建议联系平台核查原因',
        'isv.BLACK' => '黑名单管控，建议联系平台解除黑名单',
        'isv.PARAM' => '参数超出长度限制，建议修改参数长度',
        'isv.AMOUNT' => '账户余额不足，建议进行账户充值',
        'FILTER' => '关键字拦截，建议修改短信内容',
        'VALVE:M_MC' => '重复过滤，建议减少每分钟发送数量',
        'VALVE:H_MC' => '重复过滤，建议减少每小时发送数量',
        'VALVE:D_MC' => '重复过滤，建议减少每天发送数量'
    ];
}
