<?php

// namespace App\Http\Controllers;
// use App\Models\backs;
// use Illuminate\Http\Request;

// class backController extends Controller
// {
//     protected $backsModel;
//     public function __construct(backs $backsModel)
//     {
//         $this->backsModel = $backsModel;
//     }

//     public function index()
//     {
//         // 데이터 조회
//         $backs = $this->backsModel->getAllbacks();
//         return view('backs.index', compact('backs'));
//     }


//     public function store(Request $request)
//     {
//         // 데이터 생성
//         $data = $request->all();
//         $this->backsModel->createbacks($data);
//         return redirect()->route('backs.index');
//     }

//     public function show($id)
//     {
//         // 데이터 조회
//         $backs = $this->backsModel->getbacksById($id);
//         return view('backs.show', compact('backs'));
//     }

//     public function edit($id)
//     {
//         // 데이터 조회
//         $backs = $this->backsModel->getbacksById($id);
//         return view('backs.edit', compact('backs'));
//     }

//     public function update(Request $request, $id)
//     {
//         // 데이터 업데이트
//         $data = $request->all();
//         $this->backsModel->updatebacks($id, $data);
//         return redirect()->route('backs.index');
//     }

//     public function destroy($id)
//     {
//         // 데이터 삭제
//         $this->backsModel->deletebacks($id);
//         return redirect()->route('backs.index');
//     }
// }


namespace App\Http\Controllers;


use Illuminate\View\View;

class DevStackController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('devStack', [
            //
        ]);
    }
}
