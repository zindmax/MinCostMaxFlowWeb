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
                        <label for="n">Number of nodes</label>
                        <input type="number" name="n" value="" id="n" placeholder="Enter number of nodes">
                    </div>
                    <div class="d-flex flex-column me-2">
                        <label for="s">S</label>
                        <input type="number" name="s" value="" id="s" placeholder="s">
                    </div>
                    <div class="d-flex flex-column me-2">
                        <label for="t">T</label>
                        <input type="number" name="t" value="" id="t" placeholder="t">
                    </div>
                </div>
                <p>Enter edges</p>
                <div class="w-25 mb-2" id="edges">
                    <div class="d-flex flex-row mb-2">
                        <div class="d-flex flex-column me-2">
                            <label for="edge_from">From</label>
                            <input type="number" name="edges" placeholder="from" id="edge_from" value="">
                        </div>
                        <div class="d-flex flex-column me-2">
                            <label for="edge_to">To</label>
                            <input type="number" name="edges" placeholder="to" id="edge_to" value="">
                        </div>
                        <div class="d-flex flex-column me-2">
                            <label for="edge_capacity">Capacity</label>
                            <input type="number" name="edges" placeholder="capacity" id="edge_capacity" value="">
                        </div>
                        <div class="d-flex flex-column me-2">
                            <label for="edge_cost">Cost</label>
                            <input type="number" name="edges" placeholder="cost" id="edge_cost" value="">
                        </div>
                    </div>
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
    <script type="text/javascript" src="{{asset('js/edges.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/post_graph.js')}}"></script>
@endsection
