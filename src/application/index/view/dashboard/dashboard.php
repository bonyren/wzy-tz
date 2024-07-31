<style type="text/css">
    /* .info-box
=================================================================== */
    .info-box {
        display: inline-block;
        width: 20%;
        min-width: 200px;
        min-height: 140px;
        margin: 10px;
        padding: 10px;
        color: white;
        -webkit-box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.35), 0 3px 1px -1px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.35), 0 3px 1px -1px rgba(0, 0, 0, 0.1);
        box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.35), 0 3px 1px -1px rgba(0, 0, 0, 0.1);
    }

    .info-box i {
        display: block;
        height: 100px;
        font-size: 30px;
        line-height: 100px;
        text-align: center;
        margin-right: 10px;
        padding-right: 10px;
        color: rgba(255, 255, 255, 0.75);
    }

    .info-box .count {
        margin-top: -10px;
        font-size: 25px;
        font-weight: 700;
    }

    .info-box .title {
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .info-box .sub-title {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
        padding-right: 80px;
    }

    .info-box .desc {
        margin-top: 10px;
        font-size: 12px;
    }

    .info-box.danger {
        background: #ff5454;
        border: 1px solid #ff2121;
    }

    .info-box.warning {
        background: #fabb3d;
        border: 1px solid #f9aa0b;
    }

    .info-box.primary {
        background: #20a8d8;
        border: 1px solid #1985ac;
    }

    .info-box.info {
        background: #67c2ef;
        border: 1px solid #39afea;
    }

    .info-box.success {
        background: #79c447;
        border: 1px solid #61a434;
    }

    .main-bg {
        background: #e6e8ea;
    }

    .white-bg {
        color: #768399;
        background: #fff;
        background-color: #fff;
    }

    .red-bg {
        color: #fff;
        background: #d95043;
        background-color: #d95043;
    }

    .blue-bg {
        color: #fff;
        background: #57889c;
        background-color: #57889c;
    }

    .green-bg {
        color: #fff;
        background: #26c281;
        background-color: #26c281;
    }

    .greenLight-bg {
        color: #71843f;
        background: #71843f;
        background-color: #71843f;
    }

    .yellow-bg {
        color: #fff;
        background: #fc6;
        background-color: #fc6;
    }

    .orange-bg {
        color: #fff;
        background: #f4b162;
        background-color: #f4b162;
    }

    .purple-bg {
        color: #fff;
        background: #af91e1;
        background-color: #af91e1;
    }

    .pink-bg {
        color: #fff;
        background: #f78db8;
        background-color: #f78db8;
    }

    .lime-bg {
        color: #fff;
        background: #a8db43;
        background-color: #a8db43;
    }

    .magenta-bg {
        color: #fff;
        background: #e65097;
        background-color: #e65097;
    }

    .teal-bg {
        color: #fff;
        background: #97d3c5;
        background-color: #97d3c5;
    }

    .brown-bg {
        color: #fff;
        background: #d1b993;
        background-color: #d1b993;
    }

    .gray-bg {
        color: #768399;
        background: #e4e9eb;
        background-color: #e4e9eb;
    }

    .dark-bg {
        color: #fff;
        background: #79859b;
        background-color: #79859b;
    }

    .dashboard-container{
        display: flex;
        justify-content: space-around;
        align-items: center;
        height: 100%;
        overflow: auto;
    }
</style>

<div class="dashboard-container">

	<div class="info-box red-bg clearfix">
		<div class="pull-left"><i class="fa fa-users"></i></div>
		<div class="pull-left">
			<div class="count"><?=$bindValues['statistic']['totalFundCount']?></div>
			<div class="title">基金总数</div>
			<div class="sub-title">管理</div>
			<div class="count"><?=$bindValues['statistic']['totalFundManageCount']?></div>
		</div>
	</div>

	<div class="info-box orange-bg clearfix">
		<div class="pull-left"><i class="fa fa-cubes"></i></div>
		<div class="pull-left">
			<div class="count"><?=$bindValues['statistic']['totalEnterpriseCount']?></div>
			<div class="title">项目总数</div>
			<div class="sub-title">已投</div>
			<div class="count"><?=$bindValues['statistic']['totalEnterpriseInvestedCount']?></div>
		</div>
	</div>

	<div class="info-box green-bg clearfix">
		<div class="pull-left">
			<i class="fa fa-clock-o"></i>
		</div>
		<div class="pull-left">
			<div class="count"><?=$bindValues['statistic']['totalLpCount']?></div>
			<div class="title">LP总数</div>
			<div class="sub-title">已投</div>
			<div class="count"><?=$bindValues['statistic']['totalLpInvested']?></div>
		</div>
	</div>

	<div class="info-box magenta-bg clearfix">
		<div class="pull-left">
			<i class="fa fa-navicon"></i>
		</div>
		<div class="pull-left">
			<div class="count"><?=$bindValues['statistic']['totalTalentCount']?></div>
			<div class="title">Talents总数</div>
		</div>
	</div>
</div>