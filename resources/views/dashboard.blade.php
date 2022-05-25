@extends("layouts")
@section("head")
    @include('_head')
@endsection
@section("content")
    <div class="d-flex flex-row">
        <div class="d-flex flex-column">
            <form action="/graph" method="POST" id="min_cost">
                @csrf
                <div class="mb-2 d-flex flex-row">
                    <div class="d-flex flex-column me-2">
                        <label for="n">Количество вершин</label>
                        <input type="number" name="n" value="8" id="n" placeholder="Введите количество вершин">
                    </div>
                    <div class="d-flex flex-column me-2">
                        <label for="s">Исток</label>
                        <input type="number" name="s" value="1" id="s" placeholder="Исток">
                    </div>
                    <div class="d-flex flex-column me-2">
                        <label for="t">Сток</label>
                        <input type="number" name="t" value="8" id="t" placeholder="Сток">
                    </div>
                </div>
                <p>Enter edges</p>
                <div class="w-25 mb-2" id="edges">
                    <div class="d-flex flex-row mb-2">
                        <div class="d-flex flex-column me-2">
                            <label for="edge_from">From</label>
                            <input type="number" name="edges" placeholder="from" id="edge_from" value="1">
                        </div>
                        <div class="d-flex flex-column me-2">
                            <label for="edge_to">To</label>
                            <input type="number" name="edges" placeholder="to" id="edge_to" value="2">
                        </div>
                        <div class="d-flex flex-column me-2">
                            <label for="edge_capacity">Capacity</label>
                            <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="13">
                        </div>
                        <div class="d-flex flex-column me-2">
                            <label for="edge_cost">Cost</label>
                            <input type="number" name="edges" placeholder="cost" id="edge_cost" value="6">
                        </div>
                    </div>

{{--                    <div class="d-flex flex-row mb-2">--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="from" id="edge_from" value="1">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="to" id="edge_to" value="3">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="25">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="cost" id="edge_cost" value="9">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-row mb-2">--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="from" id="edge_from" value="2">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="to" id="edge_to" value="3">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="10">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="cost" id="edge_cost" value="2">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-row mb-2">--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="from" id="edge_from" value="2">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="to" id="edge_to" value="4">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="11">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="cost" id="edge_cost" value="13">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-row mb-2">--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="from" id="edge_from" value="3">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="to" id="edge_to" value="5">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="35">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="cost" id="edge_cost" value="4">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-row mb-2">--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="from" id="edge_from" value="5">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="to" id="edge_to" value="4">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="14">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="cost" id="edge_cost" value="5">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-row mb-2">--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="from" id="edge_from" value="4">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="to" id="edge_to" value="6">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="30">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="cost" id="edge_cost" value="3">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-row mb-2">--}}
{{--                        <div class="d-flex flex-column me-2">--}}

{{--                            <input type="number" name="edges" placeholder="from" id="edge_from" value="5">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}

{{--                            <input type="number" name="edges" placeholder="to" id="edge_to" value="7">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}

{{--                            <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="9">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}

{{--                            <input type="number" name="edges" placeholder="cost" id="edge_cost" value="20">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-row mb-2">--}}
{{--                            <div class="d-flex flex-column me-2">--}}

{{--                                <input type="number" name="edges" placeholder="from" id="edge_from" value="6">--}}
{{--                            </div>--}}
{{--                            <div class="d-flex flex-column me-2">--}}

{{--                                <input type="number" name="edges" placeholder="to" id="edge_to" value="7">--}}
{{--                            </div>--}}
{{--                            <div class="d-flex flex-column me-2">--}}

{{--                                <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="12">--}}
{{--                            </div>--}}
{{--                            <div class="d-flex flex-column me-2">--}}

{{--                                <input type="number" name="edges" placeholder="cost" id="edge_cost" value="3">--}}
{{--                            </div>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-row mb-2">--}}
{{--                        <div class="d-flex flex-column me-2">--}}

{{--                            <input type="number" name="edges" placeholder="from" id="edge_from" value="6">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}

{{--                            <input type="number" name="edges" placeholder="to" id="edge_to" value="8">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}

{{--                            <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="18">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}

{{--                            <input type="number" name="edges" placeholder="cost" id="edge_cost" value="10">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-row mb-2">--}}
{{--                        <div class="d-flex flex-column me-2">--}}

{{--                            <input type="number" name="edges" placeholder="from" id="edge_from" value="7">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}

{{--                            <input type="number" name="edges" placeholder="to" id="edge_to" value="8">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}

{{--                            <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="19">--}}
{{--                        </div>--}}
{{--                        <div class="d-flex flex-column me-2">--}}
{{--                            <input type="number" name="edges" placeholder="cost" id="edge_cost" value="11">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
                    <button type="submit" id="submit" class="btn btn-primary">Go!</button>
                </div>
            </form>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
                <button type="button" class="add btn btn-primary">Add Edge</button>
                <button type="button" class="remove btn btn-primary">Remove Edge</button>
            </div>
        </div>
    </div>
    <script src="{{asset('js/edges.js')}}"></script>
    <script src="{{asset('js/graph_generator.js')}}"></script>
    <script src="{{asset('js/post_graph.js')}}"></script>
@endsection
