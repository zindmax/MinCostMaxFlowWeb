<?php


namespace App\Classes;


class Algo
{
//    private $INF = 1000*1000*1000;
//    private $v_w;
//    private $P;
//    private $d;
//    private $p;
//    private $g;
//    private $e;
//    private $dijkstra;
//    private $n;
//    private $m;
//    private $s;
//
//    public function __construct(int $n, int $s, int $t, array $g, array $e)
//    {
//        $this->v_w = array_fill(0, $n, 0);
//        $this->d = array_fill(0, $n, $this->INF);
//        $this->p = array_fill(0, $n, -1);
//        $this->e = $e;
//        $this->g = $g;
//        $this->dijkstra[] = $this->d;
//        $this->n = $n;
//        $this->m = count($e);
//        $this->s = $s;
//        $this->t = $t;
//    }

    public function fillEdges(array $data) {
        $e = [];
        $g = [];
        $result = [];
        foreach ($data as $edge) {
            $e1 = new Edge();
            $e2 = new Edge();
            $e1->from = $edge['from'] - 1;
            $e1->to = $edge['to'] - 1;
            $e1->capacity = (int)$edge['capacity'];
            $e1->cost = (int)$edge['cost'];
            $e2->from = $e1->to;
            $e2->to = $e1->from;
            $e2->capacity = 0;
            $e2->cost = -$e1->cost;
            $g[$edge['from'] - 1][] = count($e);
            $e[] = $e1;
            $g[$edge['to'] - 1][] = count($e);
            $e[] = $e2;
        }
        $result['e'] = $e;
        $result['g'] = $g;
        return $result;
    }

    private function fordBelman(): void
    {

    }

    private function dijkstra()
    {

    }

    public function getMinCostMaxFlow()
    {

    }
}
