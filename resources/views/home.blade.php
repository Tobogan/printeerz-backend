@extends('layouts.templateAdmin')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif -->

<div class="uik-layout-main__wrapper">
    <div class="uik-layout-main__wrapperInner">
        <div class="uik-widget__wrapper uik-widget__margin">
            <div class="uik-widget-title__wrapper">
                <h3>Daily Visitors</h3>
                <div class="uik-analytics-home__headerActions">
                    <div class="uik-select__wrapper">
                        <button class="uik-btn__base uik-select__valueRendered" type="button">
                            <div class="uik-btn__content">
                                <div class="uik-select__valueRenderedWrapper">
                                    <div class="uik-select__valueWrapper">December</div>
                                    <div class="uik-select__arrowWrapper"></div>
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="uik-select__wrapper">
                        <button class="uik-btn__base uik-select__valueRendered" type="button">
                            <div class="uik-btn__content">
                                <div class="uik-select__valueRenderedWrapper">
                                    <div class="uik-select__valueWrapper">2018</div>
                                    <div class="uik-select__arrowWrapper"></div>
                                </div>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="uik-widget-content__wrapper">
                <div class="uik-chartjs__wrapper">
                    <div class="uik-chartjs__canvasWrapper">
                        <div class="uik-chartjs__tooltipWrapper">
                            <canvas id="chart"></canvas>
                            <div class="uik-chartjs__tooltip">
                                <div class="tooltip__content">
                                    <table></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uik-analytics-home__miniChartContainer">
            <div class="uik-widget__wrapper uik-widget-chart-summary__wrapper uik-analytics-home__miniChart uik-widget__padding uik-widget__margin"><span class="uik-widget-chart-summary__label">Realtime users</span><span class="uik-widget-chart-summary__value">848</span><span class="uik-widget-chart-summary__diff">+10.00%<i class="uikon uik-widget-chart-summary__icon">trending_up</i></span>
                <div class="uik-chartjs__wrapper uik-widget-chart-summary__chart">
                    <div class="uik-chartjs__canvasWrapper">
                        <div class="uik-chartjs__tooltipWrapper">
                            <canvas id="chart"></canvas>
                            <div class="uik-chartjs__tooltip">
                                <div class="tooltip__content">
                                    <table></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uik-widget__wrapper uik-widget-chart-summary__wrapper uik-analytics-home__miniChart uik-widget__padding uik-widget__margin"><span class="uik-widget-chart-summary__label">Total Visits</span><span class="uik-widget-chart-summary__value">54,598</span><span class="uik-widget-chart-summary__diff uik-widget-chart-summary__down">-11.81%<i class="uikon uik-widget-chart-summary__icon">trending_down</i></span>
                <div class="uik-chartjs__wrapper uik-widget-chart-summary__chart">
                    <div class="uik-chartjs__canvasWrapper">
                        <div class="uik-chartjs__tooltipWrapper">
                            <canvas id="chart"></canvas>
                            <div class="uik-chartjs__tooltip">
                                <div class="tooltip__content">
                                    <table></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uik-widget__wrapper uik-widget-chart-summary__wrapper uik-analytics-home__miniChart uik-widget__padding uik-widget__margin"><span class="uik-widget-chart-summary__label">Bounce Rate</span><span class="uik-widget-chart-summary__value">73.67</span><span class="uik-widget-chart-summary__diff">+12.20%<i class="uikon uik-widget-chart-summary__icon">trending_up</i></span>
                <div class="uik-chartjs__wrapper uik-widget-chart-summary__chart">
                    <div class="uik-chartjs__canvasWrapper">
                        <div class="uik-chartjs__tooltipWrapper">
                            <canvas id="chart"></canvas>
                            <div class="uik-chartjs__tooltip">
                                <div class="tooltip__content">
                                    <table></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uik-widget__wrapper uik-widget-chart-summary__wrapper uik-analytics-home__miniChart uik-widget__padding uik-widget__margin"><span class="uik-widget-chart-summary__label">Visit Duration</span><span class="uik-widget-chart-summary__value">1m 4s</span><span class="uik-widget-chart-summary__diff">+19.68%<i class="uikon uik-widget-chart-summary__icon">trending_up</i></span>
                <div class="uik-chartjs__wrapper uik-widget-chart-summary__chart">
                    <div class="uik-chartjs__canvasWrapper">
                        <div class="uik-chartjs__tooltipWrapper">
                            <canvas id="chart"></canvas>
                            <div class="uik-chartjs__tooltip">
                                <div class="tooltip__content">
                                    <table></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uik-analytics-home__tables">
            <div class="uik-widget__wrapper uik-analytics-home__widgetMostVisited uik-widget__margin">
                <div class="uik-widget-title__wrapper">
                    <h3>Most Visited Pages</h3></div>
                <table class="uik-widget-table__wrapper">
                    <thead>
                        <tr>
                            <th>Page Name</th>
                            <th>Visitors</th>
                            <th>Unique Page Visits</th>
                            <th>Bounce Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="uik-analytics-most-visited__contentPageName">/store/<i class="uikon uik-analytics-most-visited__iconTrend">trending_up</i></div>
                            </td>
                            <td>4,890</td>
                            <td>3,985</td>
                            <td>
                                <div class="uik-analytics-most-visited__contentBounceRate">85,17%
                                    <div class="uik-chartjs__wrapper uik-analytics-most-visited__minichart">
                                        <div class="uik-chartjs__canvasWrapper">
                                            <div class="uik-chartjs__tooltipWrapper">
                                                <canvas id="chart"></canvas>
                                                <div class="uik-chartjs__tooltip">
                                                    <div class="tooltip__content">
                                                        <table></table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="uik-analytics-most-visited__contentPageName">/store/symbol-styleguides<i class="uikon uik-analytics-most-visited__iconTrend">trending_up</i></div>
                            </td>
                            <td>1,824</td>
                            <td>2,391</td>
                            <td>
                                <div class="uik-analytics-most-visited__contentBounceRate">38,37%
                                    <div class="uik-chartjs__wrapper uik-analytics-most-visited__minichart">
                                        <div class="uik-chartjs__canvasWrapper">
                                            <div class="uik-chartjs__tooltipWrapper">
                                                <canvas id="chart"></canvas>
                                                <div class="uik-chartjs__tooltip">
                                                    <div class="tooltip__content">
                                                        <table></table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="uik-analytics-most-visited__contentPageName">/store/dashboard-ui-kit<i class="uikon uik-analytics-most-visited__iconTrend">trending_up</i></div>
                            </td>
                            <td>8,123</td>
                            <td>5,293</td>
                            <td>
                                <div class="uik-analytics-most-visited__contentBounceRate">67,13%
                                    <div class="uik-chartjs__wrapper uik-analytics-most-visited__minichart">
                                        <div class="uik-chartjs__canvasWrapper">
                                            <div class="uik-chartjs__tooltipWrapper">
                                                <canvas id="chart"></canvas>
                                                <div class="uik-chartjs__tooltip">
                                                    <div class="tooltip__content">
                                                        <table></table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="uik-analytics-most-visited__contentPageName">/store/webflow-cards.html<i class="uikon uik-analytics-most-visited__iconTrend">trending_up</i></div>
                            </td>
                            <td>2,440</td>
                            <td>1,789</td>
                            <td>
                                <div class="uik-analytics-most-visited__contentBounceRate">39,59%
                                    <div class="uik-chartjs__wrapper uik-analytics-most-visited__minichart">
                                        <div class="uik-chartjs__canvasWrapper">
                                            <div class="uik-chartjs__tooltipWrapper">
                                                <canvas id="chart"></canvas>
                                                <div class="uik-chartjs__tooltip">
                                                    <div class="tooltip__content">
                                                        <table></table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="uik-widget__wrapper uik-widget__margin">
                <div class="uik-widget-title__wrapper">
                    <h3>Social Media Traffic</h3></div>
                <table class="uik-widget-table__wrapper uik-analytics-social-media__table">
                    <thead>
                        <tr>
                            <th>Network</th>
                            <th>Visitors</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Instagram</td>
                            <td>
                                <div class="uik-analytics-social-media__contentVisitors">4,890
                                    <div class="uik-progress-bar__wrapper uik-analytics-social-media__progressBar">
                                        <div class="uik-progress-bar__progressLine" style="width:70%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Facebook</td>
                            <td>
                                <div class="uik-analytics-social-media__contentVisitors">1,824
                                    <div class="uik-progress-bar__wrapper uik-analytics-social-media__progressBar">
                                        <div class="uik-progress-bar__progressLine" style="width:13%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Twitter</td>
                            <td>
                                <div class="uik-analytics-social-media__contentVisitors">8,123
                                    <div class="uik-progress-bar__wrapper uik-analytics-social-media__progressBar">
                                        <div class="uik-progress-bar__progressLine" style="width:37%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>LinkedIn</td>
                            <td>
                                <div class="uik-analytics-social-media__contentVisitors">63
                                    <div class="uik-progress-bar__wrapper uik-analytics-social-media__progressBar">
                                        <div class="uik-progress-bar__progressLine" style="width:57%"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
                     
@endsection
