<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Domain\Comment\DomainService\CommentDomainService;

class CommentController extends Controller
{
    private CommentDomainService $commentDomainService;

    public function __construct(
        CommentDomainService $commentDomainService
    ) {
        $this->commentDomainService = $commentDomainService;
    }
    
    public function save(Request $request)
    {
        $params = $request->all();
        
        $this->commentDomainService->store($params);

        return redirect()->route('historyDetail', ['id' => $params['movie_history_id']])->with('flash_message', 'コメントを投稿しました！');
    }

    public function delete(int $id)
    {
        $movieHistoryId = $this->commentDomainService->delete($id);

        return redirect()->route('historyDetail', ['id' => $movieHistoryId])->with('flash_message', 'コメントを削除しました！');
    }
}
