@extends("layouts")
@section("head")
    @include("_head")
@endsection
@section("content")
    @foreach($minCostMaxFlow as $key => $step)
        <span><?echo "Шаг " . $key + 1?></span>
        <table class="table table-bordered">
            <thead>
            <tr>
                @for($i = 0; $i < $n; $i++)
                    <th scope="col">
                        <?echo $i + 1?>
                    </th>
                @endfor
            </tr>
            </thead>
            @foreach($step["dijkstra"] as $key => $dijkstra)
                <tr class="text-end">
                    @foreach($dijkstra as $dijkstra_step)
                        <td>
                            <?echo $dijkstra_step?>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
        <p class="text-end">
            <span>Track: </span>
            @foreach($step["track"] as $track_i)
                <?echo $track_i + 1?>
            @endforeach
        </p>
        <p class="text-end">
            <?echo "Flow: " . $step["flow"]?>
        </p>
        <p class="text-end">
            <?echo "Cost: " . $step["cost"]?>
        </p>
        <div id="canvas"></div>
    @endforeach
    <p>Ответ: </p>
    <p>
    <?echo "Max Flow: " . $result["result_flow"]?>
    </p>
    <p>
    <?echo "Answer: " . $result["result_cost"]?>
    </p>
    <script src="{{asset('js/graph_generator.js')}}"></script>
@endsection
