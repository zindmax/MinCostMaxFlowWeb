<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {

        dd($request);
        $n = $request->input("n");
        $s = $request->input("s") - 1;
        $t = $request->input("t") - 1;

        $g = [];
        $e = [];

        foreach ($request->input("edges") as $edge) {
            $e1 = new \App\Classes\Edge();
            $e2 = new \App\Classes\Edge();
            $e1->from = $edge["from"] - 1;
            $e1->to = $edge["to"] - 1;
            $e1->capasity = (int)$edge["capacity"];
            $e1->cost = (int)$edge["cost"];
            $e2->from = $e1->to;
            $e2->to = $e1->from;
            $e2->capasity = 0;
            $e2->cost = -$e1->cost;
            $g[$edge["from"] - 1][] = count($e);
            $e[] = $e1;
            $g[$edge["to"] - 1][] = count($e);
            $e[] = $e2;
        }
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

        for ($i = 0; $i < $n; $i++) {
            $v_w[$i] = $d[$i];
        }
        //mincost
        $max_cost = 0;
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
                if ($e[$p[$i]]->capasity - $e[$p[$i]]->flow < $maxFlow) {
                    $maxFlow = $e[$p[$i]]->capasity - $e[$p[$i]]->flow;
                }
            }
            $max_flow += $maxFlow;
            $max_cost += $maxFlow * $v_w[$t];
            for ($i = count($p) - 1; $p[$i] !== -1; $i = $e[$p[$i]]->from) {
                $e[$p[$i]]->flow += $maxFlow;
                $e[$p[$i] ^ 1]->flow -= $maxFlow;
            }
            //new edge w
            for ($i = 0; $i < $m; $i+=2) {
                if ($e[$i]->capasity === $e[$i]->flow) {
                    $e[$i]->w = 0;
                    $e[$i ^ 1]->w = $e[$i ^ 1]->cost + $v_w[$e[$i ^ 1]->from] - $v_w[$e[$i ^ 1]->to];
                }else{
                    $e[$i]->w = $e[$i]->cost + $v_w[$e[$i]->from] - $v_w[$e[$i]->to];
                    $e[$i ^ 1]->w = $e[$i]->cost + $v_w[$e[$i ^ 1]->to] - $v_w[$e[$i ^ 1]->from];
                }
            }

            $step["v_w"] = $v_w;
            $step["track"] = $P;
            $step["flow"] = $maxFlow;
            $step["cost"] = $d[$t];
            $step["dijkstra"] = $dijkstra;
            $minCostMaxFlow[] = $step;
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
                    if ($e[$e_index]->flow === $e[$e_index]->capasity) {
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

            for ($j = 0; $j < $n; $j++) {
                $v_w[$j] += $d[$j];
            }

            $P = [];
            for ($v = $t; $p[$v] !== -1; $v = $e[$p[$v]]->from) {
                $P[] = $v;
            }
            $P[] = $s;
            $P = array_reverse($P);
        }
        $result["result_cost"] = $max_cost;
        $result["result_flow"] = $max_flow;

        return view("graph", ["minCostMaxFlow" => $minCostMaxFlow, "result" => $result, "n" => $n]);
    }
}
