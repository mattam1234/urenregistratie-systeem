
@extends('layouts.app')
@section('style')
<style>
    body{
        background-image: url("{{asset('images/background.png')}}");
    }
    .grid-container {
        height: 70%;
        display: grid;
        grid-template-columns: auto auto auto;
        grid-template-rows: auto auto;
        padding: 10px;
        grid-gap: 3em;
    }
    .grid-item {
        padding: 20px;
        font-size: 30px;
        border: #707070 solid 1px;
        background-color: #FFFFFF;
    }
    .grid-item1{
        grid-row: 1/3;
    }
    p{
        font-size: 18px;
    }
</style>
@endsection
@section('content')
    <div class="grid-container">
        <div class="grid-item grid-item1">
            <h4>
                Takenlijst
            </h4>
            <p>
                actieve taak:
            </p>
            <p>
                progressie:
            </p>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="70"
                     aria-valuemin="0" aria-valuemax="100" style="width:30%">
                </div>
            </div>
            <p>
                takenlijst inhoud:
            </p>
            <div class="taskcontainer">

            </div>
        </div>
        <div class="grid-item grid-item2">
            <h4>
                Weekoverzicht
            </h4>
        </div>
        <div class="grid-item grid-item3">
            <h4>
                Team overzicht
            </h4>
        </div>
        <div class="grid-item grid-item4">
            <h4>
                Verlof aanvragen
            </h4>
        </div>
        <div class="grid-item grid-item5">
            <h4>
                uren overzicht
            </h4>
            <div id="container" style="width: 100%; height: 100%;"></div>
            <script>
                var names = [ 'gemaakte uren', 'beschikbaare uren', 'uren achtergelopen', 'uren totaal'];
                var data = [3,2,1,6];
                var dataSet = anychart.data.set(data);
                var palette = anychart.palettes.distinctColors().items(['blue', 'lightblue', 'red', 'green']);

                var makeBarWithBar = function (gauge, radius, i, width, without_stroke) {
                    var stroke = '1 #e5e4e4';
                    if (without_stroke) {
                        stroke = null;
                        gauge.label(i)
                            .text(names[i] + ', <span style="">' + data[i] + '</span>')// color: #7c868e
                            .useHtml(true);
                        gauge.label(i)
                            .hAlign('center')
                            .vAlign('middle')
                            .anchor('right-center')
                            .padding(0, 5)
                            .height(width / 2 + '%')
                            .offsetY(radius + '%')
                            .offsetX(0);
                    }

                    gauge.bar(i).dataIndex(i)
                        .radius(radius)
                        .width(width)
                        .fill(palette.itemAt(i))
                        .stroke(null)
                        .zIndex(5);
                    gauge.bar(i + 100).dataIndex(5)
                        .radius(radius)
                        .width(width)
                        .fill('#F5F4F4')
                        .stroke(stroke)
                        .zIndex(4);

                    return gauge.bar(i)
                };

                anychart.onDocumentReady(function () {
                    var gauge = anychart.gauges.circular();
                    gauge.data(dataSet);
                    gauge.fill('#fff')
                        .stroke(null)
                        .padding(0)
                        .margin(0)
                        .startAngle(0)
                        .sweepAngle(270);

                    var axis = gauge.axis().radius(100).width(1).fill(null);
                    axis.scale()
                        .minimum(0)
                        .maximum(12)
                        .ticks({interval: 1})
                        .minorTicks({interval: 1});
                    axis.labels().enabled(false);
                    axis.ticks().enabled(false);
                    axis.minorTicks().enabled(false);
                    makeBarWithBar(gauge, 100, 0, 17, true);
                    makeBarWithBar(gauge, 80, 1, 17, true);
                    makeBarWithBar(gauge, 60, 2, 17, true);
                    makeBarWithBar(gauge, 40, 3, 17, true);
                    makeBarWithBar(gauge, 20, 4, 17, true);

                    gauge.margin(50);


                    gauge.container('container');
                    gauge.draw();
                });
            </script>
        </div>
    </div>
@endsection
