<?php

namespace App\Http\Controllers;

use App\Classes\Algo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $graphData = $request->all()['data'];
        $n = $graphData['0'];
        $s = $graphData['1'] - 1;
        $t = $graphData['2'] - 1;

        $graph_info = (new \App\Classes\Algo())->fillEdges($graphData['3']);
        $e = $graph_info['e'];
        $g = $graph_info['g'];

        $INF = 1000*1000*1000;
        $v_w = array_fill(0, $n, 0);
        $P = [];
        $d = array_fill(0, $n, $INF);
        $p = array_fill(0, $n, -1);
        $d[$s] = 0;

        $minCostMaxFlow = [];
        $dijkstra = [];
        $step = [];
        $dijkstra[] = $d;
        $m = count($e);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $m; $j += 2) {
                if ($d[$e[$j]->from] < $INF) {
                    if ($d[$e[$j]->to] > $d[$e[$j]->from] + $e[$j]->cost) {
                        $d[$e[$j]->to] = $d[$e[$j]->from] + $e[$j]->cost;
                        $p[$e[$j]->to] = $j;
                        $dijkstra[] = $d;
                    }
                }
            }
        }

        $cost = $d[$t];
        for ($cur = $n - 1; $p[$cur] !== -1; $cur = $e[$p[$cur]]->from) {
            $P[] = $cur;
        }
        $P[] = $s;
        $P = array_reverse($P);

        $step['v_w'] = $v_w;

        for ($i = 0; $i < $n; $i++) {
            $v_w[$i] = $d[$i] - 1;
        }

        foreach ($e as $edge) {
            $step['edges_w'][] = $edge->cost;
        }

        $step['edges_flow'] = array_fill(0, count($e), 0);
        $step['track'] = $P;
        $step['cost'] = $d[$t];
        $step['dijkstra'] = $dijkstra;
//        mincost
        $min_cost = 0;
        $max_flow = 0;
        for (;;) {
            if ($v_w[$t] >= $INF) {
                $step["track"] = [];
                $step["flow"] = 0;
                $step["cost"] = 0;
                $step["dijkstra"] = $dijkstra;
                $minCostMaxFlow[] = $step;
                break;
            }
            //findMaxFlow
            $maxFlow = PHP_INT_MAX;
            for ($i = count($p) - 1; $p[$i] !== -1; $i = $e[$p[$i]]->from) {
                if ($e[$p[$i]]->capacity - $e[$p[$i]]->flow < $maxFlow) {
                    $maxFlow = $e[$p[$i]]->capacity - $e[$p[$i]]->flow;
                }
            }
            $step['flow'] = $maxFlow;
            $minCostMaxFlow[] = $step;

            $max_flow += $maxFlow;
            $min_cost += $maxFlow * $v_w[$t];
            for ($i = count($p) - 1; $p[$i] !== -1; $i = $e[$p[$i]]->from) {
                $e[$p[$i]]->flow += $maxFlow;
                $e[$p[$i] ^ 1]->flow -= $maxFlow;
            }
            //get edges flow
            $edges_flow = [];
            foreach ($e as $edge) {
                $edges_flow[] = $edge->flow;
            }
            $step['edges_flow'] = $edges_flow;
            //new edge w
            $edges_w = [];
            for ($i = 0; $i < $m; $i+=2) {
                if ($e[$i]->capacity === $e[$i]->flow) {
                    $e[$i]->w = 0;
                    $e[$i ^ 1]->w = $e[$i ^ 1]->cost + $v_w[$e[$i ^ 1]->from] - $v_w[$e[$i ^ 1]->to];
                }else{
                    $e[$i]->w = $e[$i]->cost + $v_w[$e[$i]->from] - $v_w[$e[$i]->to];
                    $e[$i ^ 1]->w = $e[$i]->cost + $v_w[$e[$i ^ 1]->to] - $v_w[$e[$i ^ 1]->from];
                }
                $edges_w[] = $e[$i]->w;
                $edges_w[] = $e[$i ^ 1]->w;
            }
            //dijkstra
            $d = array_fill(0, $n, $INF);
            $u = array_fill(0, $n, false);
            $dijkstra = [];
            $d[$s] = 0;
            $dijkstra[] = $d;
            for ($i = 0; $i < $n; $i++) {
                $v = -1;
                for ($j = 0; $j < $n; $j++) {
                    if (!$u[$j] && ($v === -1 || $d[$j] < $d[$v])) {
                        $v = $j;
                    }
                }
                if ($d[$v] === $INF) {
                    break;
                }
                $u[$v] = true;
                foreach ($g[$v] as $e_index) {
                    if ($e[$e_index]->flow === $e[$e_index]->capacity) {
                        continue;
                    }
                    $to = $e[$e_index]->to;
                    $len = $e[$e_index]->w;
                    if ($d[$to] > $d[$v] + $len) {
                        $d[$to] = $d[$v] + $len;
                        $p[$to] = $e_index;
                        $dijkstra[] = $d;
                    }
                }
            }

            $step['v_w'] = $v_w;

            for ($j = 0; $j < $n; $j++) {
                $v_w[$j] += $d[$j];
            }

            $P = [];
            for ($v = $t; $p[$v] !== -1; $v = $e[$p[$v]]->from) {
                $P[] = $v;
            }
            $P[] = $s;
            $P = array_reverse($P);
            $step['edges_w'] = $edges_w;
            $step['dijkstra'] = $dijkstra;
            $step['track'] = $P;
            $step['cost'] = $d[$t];
        }

        $result['result_cost'] = $min_cost;
        $result['result_flow'] = $max_flow;

        return response()->json([
            'edges' => $e,
            'minCostMaxFlow' => $minCostMaxFlow,
            'result' => $result,
            'n' => $n]);
    }

    public function showGraph(Request $request)
    {
        $data = json_decode($request->query('graphData'), true);
        return view('graph', [
            'minCostMaxFlow' => $data['minCostMaxFlow'],
            'result' => $data['result'],
            'n' => $data['n'],
        ]);
    }
}
