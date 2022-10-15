@extends('wap.layouts.creditpay_base')

@section('content')
    <div class="box">
        <div class="title">
            <h4>活动详情</h4>
        </div>
        <div class="txt-box">
            <p>
                <span style="color: rgb(98, 98, 98); font-size: medium; white-space: normal;">即日起，凡是在{{ systemconfig('site_name') }}</span>
                <span style="list-style: none; margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: inherit; font-size: medium; white-space: normal; font-stretch: inherit; font-variant-numeric: inherit;">{{ systemconfig('site_domain') }}</span>
                <span style="color: rgb(98, 98, 98); font-size: medium; white-space: normal;">的‘电子、棋牌、捕鱼、真人’升级模式等级达到</span>
                <span style="color: rgb(255, 0, 0); font-size: medium; white-space: normal;">1
                    <span style="list-style: none; margin: 0px; padding: 0px; line-height: inherit; font-stretch: inherit; font-variant-numeric: inherit;">级</span>
                </span>
                <span style="color: rgb(98, 98, 98); font-size: medium; white-space: normal;">的会员，均可申请无利息借贷，0抵押，0担保！所借款的额度，直接添加至会员账号，可直接提款。可借款总额=电子信用额度+真人信用额度
                    <span style="color: rgb(98, 98, 98); font-size: medium; white-space: normal;">+信用借支</span>。
                </span>
            </p>
        </div>
    </div>

    {{--
    <div class="box">
        <div class="title">
            <h4>交易规则</h4>
        </div>
        <div class="txt-box" style="text-indent:0em !important;">
            <p style="list-style: none; padding: 0px; line-height: 30px; margin-top: 0px; margin-bottom: 0px; white-space: normal; font-stretch: inherit; font-variant-numeric: inherit; font-variant-east-asian: inherit;">
                <span style="font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;"><span style="color: rgb(0, 0, 0);">购买会员账号后首次申请（免息借呗）申请条件为：</span><span
                            style="list-style: none; margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit;">（电子升级模式或真人升级模式原等级基础上提升一级）</span><span
                            style="color: rgb(0, 0, 0);">即可参与！</span></span></p>
            <p style="list-style: none; padding: 0px; line-height: 30px; margin-top: 0px; margin-bottom: 0px; white-space: normal; font-stretch: inherit; font-variant-numeric: inherit; font-variant-east-asian: inherit;">
                <span style="font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;"><span
                            style="list-style: none; margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit;">例如</span><span
                            style="color: rgb(98, 98, 98);">：</span><span
                            style="color: rgb(0, 0, 0);">原电子升级模式等级为</span><span
                            style="list-style: none; margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit;">5级</span><span
                            style="color: rgb(0, 0, 0);">，购买会员账号后等级升级为</span><span
                            style="list-style: none; margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: inherit; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit;">6级</span><span
                            style="color: rgb(0, 0, 0);">，即可参加（免息借呗）活动哦！</span></span></p>
        </div>
    </div>
    --}}

    <div class="box">
        <div class="title">
            <h4>信用规则</h4>
        </div>
        <div class="txt-box" style="text-indent:0em !important;">
            <p><span style="font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">
                    <span style="color: rgb(0, 0, 0);">1.会员</span><span style="color: rgb(255, 0, 0);">还清借款，1分钟</span><span style="color: rgb(0, 0, 0);">后即可再次拥有可借款额度！</span></span></p><p style="white-space: normal;"><span style="font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">
                    <span style="color: rgb(0, 0, 0);">2.</span><span style="white-space: normal;"><span style="color: rgb(0, 0, 0);">会员‘<span style="color: rgb(0, 0, 0); font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; white-space: normal;">已借款</span>’金额等于‘<span style="color: rgb(0, 0, 0); font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; white-space: normal;">最高借款</span>’金额且尚</span><span style="color: rgb(255, 0, 0);">未还款</span><span style="color: rgb(0, 0, 0);">，则无法再次进行</span><span style="color: rgb(255, 0, 0);">借款</span>！</span></span></p><p style="white-space: normal;"><span style="font-family: 微软雅黑, Microsoft YaHei; font-size: 16px; white-space: normal;">
                    {{--<span style="color: rgb(0, 0, 0);">3.按时还款可申请</span><span style="color: rgb(255, 0, 0);">信用借支</span><span style="color: rgb(0, 0, 0);">提升借款额度</span><span style="color: rgb(0, 0, 0);">，有过逾期还款系统将自动</span><span style="color: rgb(255, 0, 0);">降低借款额度</span><span style="white-space: normal;">！</span><span style="color: rgb(98, 98, 98); white-space: normal;"></span></span></p><p style="white-space: normal;">--}}
                    <span style="color: rgb(0, 0, 0); font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">3.会员若</span><span style="color: rgb(255, 0, 0); font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;"><span id="_baidu_bookmark_start_0" style="line-height: 0px; display: none;">&zwj;</span>逾期未还款</span><span style="color: rgb(0, 0, 0); font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">，则电子、棋牌、捕鱼升级模式周俸禄、月俸禄和真人升级模式月俸禄将</span><span style="color: rgb(255, 0, 0); font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;">不予派送，直至还清后正常派送</span><span style="color: rgb(0, 0, 0); font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">。</span></p><p style="white-space: normal;"><span style="font-family: 微软雅黑, &quot;Microsoft YaHei&quot;; font-size: 16px;">
                    <span style="color: rgb(0, 0, 0);">4.</span><span style="white-space: normal;"><span style="color: rgb(0, 0, 0);">信用就是价值，价值就是金钱！</span><span style="color: rgb(255, 0, 0);">未还清借款金额则会冻结账户，直至还清后解冻</span><span style="color: rgb(0, 0, 0);">！</span></span></span></p><p style="white-space: normal;">
                {{--<span style="color: rgb(0, 0, 0); font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">5.<span style="white-space: normal;">可借款总额越多，会员账号价值越高，在交易账号买卖中，也就能卖出更高的价格！</span></span></p><p style="white-space: normal;"><span style="font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">--}}
                <span style="color: rgb(0, 0, 0);">5.会员借款时间：</span><span style="color: rgb(255, 0, 0);">最长时间为 {{ \App\Models\CreditPayRecord::CREDIT_PAY_DAYS }} 天</span><span style="color: rgb(0, 0, 0);">，最短时间无限制！</span></span></p><p style="white-space: normal;"><span>
                    <span style="color: rgb(0, 0, 0); font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">6.</span><span style="white-space: normal;"><span style="font-family: 微软雅黑, Microsoft YaHei;"><span style="font-size: 16px;"><span style="color: rgb(0, 0, 0);">{{ systemconfig('site_name') }}借呗保留最终解释权！</span></span></span><span id="_baidu_bookmark_end_1" style="line-height: 0px; display: none;">&zwj;</span></span></span></p>
        </div>
    </div>
    <div class="box">
        <div class="title">
            <h4>活动细则</h4>
        </div>
        <div class="hdxz-txt-box">
            <p style="white-space: normal;"><span
                        style="color: rgb(0, 0, 0); font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;"><span
                            id="_baidu_bookmark_start_2" style="line-height: 0px; display: none;">‍</span><span
                            id="_baidu_bookmark_start_0" style="line-height: 0px; display: none;">‍</span><span
                            id="_baidu_bookmark_start_2" style="line-height: 0px; display: none;">‍</span>1.借款总额=电子、棋牌、捕鱼信用额度+真人信用额度。</span>
            </p>
            <p style="white-space: normal;"><span
                        style="color: rgb(0, 0, 0); font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">2.电子、棋牌、捕鱼等级，由电子、棋牌、捕鱼有效投注决定，投注越多，等级越高。</span>
            </p>
            <p style="white-space: normal;"><span
                        style="color: rgb(0, 0, 0); font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">3.电子、棋牌、捕鱼信用额度，由电子棋牌升级模式决定，等级越高，信用额度就越高。</span>
            </p>
            <p style="white-space: normal;"><span
                        style="color: rgb(0, 0, 0); font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">4.真人等级，由真人视讯有效投注决定，投注越多，等级越高。</span>
            </p>
            <p style="white-space: normal;"><span
                        style="color: rgb(0, 0, 0); font-family: 微软雅黑, Microsoft YaHei; font-size: 16px;">5.真人信用额度，由真人升级模式决定，等级越高，信用额度就越高。</span>
            </p>
            <p style="white-space: normal;">
            </p>
            <p style="white-space: normal;"><span><span style="font-family: 微软雅黑, Microsoft YaHei;"><span
                                style="font-size: 16px;"><span style="color: rgb(0, 0, 0);">6.{{ systemconfig('site_name') }}免息借呗保留对活动的最终解释权，参与该优惠，即表示您同意遵守《优惠规则与条款》。</span><span
                                    id="_baidu_bookmark_end_3"
                                    style="line-height: 0px; display: none;">‍</span></span><span
                                id="_baidu_bookmark_end_1" style="line-height: 0px; display: none;">‍</span></span><span
                            id="_baidu_bookmark_end_3" style="line-height: 0px; display: none;">‍</span></span></p>
        </div>
    </div>
@endsection