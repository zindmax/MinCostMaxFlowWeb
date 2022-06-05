@extends("layouts")
@section("head")
    @include("_head")
@endsection
@section("content")
    <div class="slideshow-container">
        @foreach($minCostMaxFlow as $stepNum => $step)
            <div class="slide">
                <div class="d-flex flex-row">
                    <div id='<?='canvas'.$stepNum?>'></div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">V</th>
                            <th scope="col">Потенциал</th>
                        </tr>
                        </thead>
                        @foreach($step['v_w'] as $index => $w)
                            <tr class="text-end">
                                <td>{{$index + 1}}</td>
                                @if ($stepNum > 0)
                                <td>{{$w + 1}}</td>
                                @else
                                <td>{{$w}}</td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                </div>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                <button type="button" class="btn btn-secondary mb-2" onclick="showTable({{$stepNum + 1}})">
                    <?php echo "Шаг " . $stepNum + 1?>
                </button>
                <div>
                    <table id="{{$stepNum + 1}}" class="table table-bordered d-table d-none">
                        <thead>
                        <tr>
                            @for($i = 0; $i < $n; $i++)
                                <th scope="col">
                                    <?php echo $i + 1?>
                                </th>
                            @endfor
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($step["dijkstra"] as $key => $dijkstra)
                            <tr class="text-end">
                                @foreach($dijkstra as $dijkstra_step)
                                    <td>
                                        @if($dijkstra_step === 1000000000)
                                            <?php echo '&#8734'?>
                                        @else
                                            <?php echo $dijkstra_step?>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <p class="text-end">
                        <span>Track: </span>
                        @foreach($step["track"] as $track_i)
                            <?php echo $track_i + 1?>
                        @endforeach
                    </p>
                    <p class="text-end">
                        <?php echo "Cost: " . $step["cost"]?>
                    </p>
                    <p class="text-end">
                        <?php echo "Flow: " . $step["flow"]?>
                    </p>
                </div>
                @if ($stepNum === count($minCostMaxFlow) - 1)
                    <p>Ответ: </p>
                    <p>
                        <?php echo "Max Flow: " . $result["result_flow"]?>
                    </p>
                    <p>
                        <?php echo "Max Cost: " . $result["result_cost"]?>
                    </p>
                @endif
            </div>
        @endforeach
    </div>
    <script type="text/javascript" src="{{asset('js/graph_generator.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/slider.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/show_hide_table.js')}}"></script>
    <link href="{{asset('css/slider.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
@endsection
