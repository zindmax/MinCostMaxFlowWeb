@extends("layouts")
@section("head")
    @include("_head")
@endsection
@section("content")
    @foreach($minCostMaxFlow as $stepNum => $step)
        <span><?php echo "Шаг " . $stepNum + 1?></span>
        <table class="table table-bordered">
            <thead>
            <tr>
                @for($i = 0; $i < $n; $i++)
                    <th scope="col">
                        <?php echo $i + 1?>
                    </th>
                @endfor
            </tr>
            </thead>
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
        </table>
        <p class="text-end">
            <span>Track: </span>
            @foreach($step["track"] as $track_i)
                <?php echo $track_i + 1?>
            @endforeach
        </p>
        <p class="text-end">
            <?php echo "Flow: " . $step["flow"]?>
        </p>
        <p class="text-end">
            <?php echo "Cost: " . $step["cost"]?>
        </p>
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
                        <td>{{$w + 1}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endforeach
    <p>Ответ: </p>
    <p>
    <?php echo "Max Flow: " . $result["result_flow"]?>
    </p>
    <p>
    <?php echo "Max Cost: " . $result["result_cost"]?>
    </p>
    <script src="{{asset('js/graph_generator.js')}}"></script>
@endsection
