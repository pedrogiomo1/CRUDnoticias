<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $news = new News();

        $news->title = $request->title;
        $news->subtitle = $request->subtitle;
        $news->content = $request->content;

        try {
            $news->save();
        } catch (\Exception $th) {
            $response = [
                'Code' => '400',
                'Type' => 'Error',
                'Message' => $th->getMessage(),
                'Data' => ''
            ];
            return new JsonResponse($response, 400);
        }
        $response = [
            'Code' => '200',
            'Type' => 'Success',
            'Message' => 'Notícia criada com sucesso',
            'Data' => $news
        ];
        return new JsonResponse($response, 200);
    }

    public function read(Request $request): JsonResponse
    {      
        try {
            $news = News::get();
        } catch (\Exception $th) {
            $response = [
                'Code' => '400',
                'Type' => 'Error',
                'Message' => $th->getMessage(),
                "Data" => null
            ];
            return new JsonResponse($response, 400);
        }

        $response = [
            'Code' => '200',
            'Type' => 'Success',
            'Message' => 'Lista de Notícias!',
            "Data" => $news
        ];

        return new JsonResponse($response, 200);

    }

    public function readById(Request $request, $id): JsonResponse
    {      
        try {
            $news = News::findOrFail($id);            
        } catch (\Exception $th) {
            $response = [
                'Code' => '400',
                'Type' => 'Error',
                'Message' => $th->getMessage(),
                "Data" => null       
            ];
            return new JsonResponse($response, 400);
        }

        $response = [
            'Code' => '200',
            'Type' => 'Success',
            'Message' => 'Aqui está a Notícia!',
            "Data" => $news

        ];
        return new JsonResponse($response, 200);        
    }
    
    public function update(Request $request, $id): JsonResponse
    {
        $news = News::findOrFail($id);
        
        $news->update([
            'title'=>$request->title,
            'subtitle'=>$request->subtitle,
            'content'=>$request->content
        ]);

        $response = [
            'Code' => '200',
            'Type' => 'Success',
            'Message' => 'Notícia atualizada!',
            "Data" => $news
        ];
        
        return new JsonResponse($response, 200);
    }

    public function delete($id): JsonResponse
    {
        try {
            $news = News::findOrFail($id);

            $news->delete();
        } catch (\Exception $th) {
            $response = [
                'Code' => '400',
                'Type' => 'Error',
                'Message' => $th->getMessage(),
                "Data" => null
    
            ];
    
            return new JsonResponse($response, 400);
        }

        $response = [
            'Code' => '200',
            'Type' => 'Success',
            'Message' => 'Notícia Excluida!',
            "Data" => ''
        ];

        return new JsonResponse($response, 200);
    }

}
?>