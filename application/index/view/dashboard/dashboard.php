<style type="text/css">
    .dashboard-container{
        display: flex;
        justify-content: space-around;
        align-items: center;
        height: 100%;
        overflow: auto;
    }
    .info-box {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
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
    .info-box>div:first-child{
        display: flex;
        align-items: center;
    }
    .info-box .count {
        font-size: 25px;
        font-weight: 700;
    }

    .info-box .title {
        font-size: 18px;
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .info-box .sub-title {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 5px;
        padding-right: 80px;
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
    .orange-bg {
        color: #fff;
        background: #f4b162;
        background-color: #f4b162;
    }
    .magenta-bg {
        color: #fff;
        background: #e65097;
        background-color: #e65097;
    }
</style>

<div class="dashboard-container">
	<div class="info-box red-bg clearfix">
		<div><i class="fa fa-money fa-3x"></i></div>
		<div>
			<div class="count"><?=$bindValues['statistic']['totalFundCount']?></div>
			<div class="title">基金总数</div>
			<div class="sub-title">管理</div>
			<div class="count"><?=$bindValues['statistic']['totalFundManageCount']?></div>
		</div>
	</div>

	<div class="info-box orange-bg clearfix">
		<div><i class="fa fa-cubes fa-3x"></i></div>
		<div>
			<div class="count"><?=$bindValues['statistic']['totalEnterpriseCount']?></div>
			<div class="title">项目总数</div>
			<div class="sub-title">已投</div>
			<div class="count"><?=$bindValues['statistic']['totalEnterpriseInvestedCount']?></div>
		</div>
	</div>

	<div class="info-box green-bg clearfix">
		<div>
			<i class="fa fa-clock-o fa-3x"></i>
		</div>
		<div>
			<div class="count"><?=$bindValues['statistic']['totalLpCount']?></div>
			<div class="title">LP总数</div>
			<div class="sub-title">已投</div>
			<div class="count"><?=$bindValues['statistic']['totalLpInvested']?></div>
		</div>
	</div>

	<div class="info-box magenta-bg clearfix">
		<div>
			<i class="fa fa-navicon fa-3x"></i>
		</div>
		<div>
			<div class="count"><?=$bindValues['statistic']['totalTalentCount']?></div>
			<div class="title">Talents总数</div>
		</div>
	</div>
</div>