<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class GalaoController extends Controller
{
    public function index()
    {
        return view('enviar_informacoes');
    }

    public function calcular(Request $request)
    {
        $request->validate([
            'galao_volume' => 'required|numeric',
            'garrafas.*' => 'required|numeric|min:0',
        ]);

        $galaoVolume = $request->galao_volume;
        $garrafas = $request->garrafas;

        
        rsort($garrafas);

        
        $garrafasEscolhidas = [];
        $sobraGalao = $galaoVolume;

       
        foreach ($garrafas as $garrafa) {
            if ($sobraGalao >= $garrafa) {
                $garrafasEscolhidas[] = $garrafa;
                $sobraGalao -= $garrafa;
            }
        }

        $data = [
            'galao_volume' => $galaoVolume,
            'garrafas_escolhidas' => implode(',', $garrafasEscolhidas),
            'sobra_galao' => $sobraGalao
        ];

        $this->escreverCSV($data);

        return view('resultados', compact('garrafasEscolhidas', 'sobraGalao'));
    }

    private function escreverCSV($data){
    $fileName = 'resultados.csv';

    if (!Storage::disk('local')->exists($fileName)) {
        Storage::disk('local')->put($fileName, "Galão Volume|Garrafas Escolhidas|Sobra Galão\n");
    }

    $line = implode('|', $data) . "\n";

    
    $line = rtrim($line, "\n");

    Storage::disk('local')->append($fileName, $line);
    }

    public function verResultados()
    {
        $fileName = 'resultados.csv';

        if (Storage::disk('local')->exists($fileName)) {
            $contents = Storage::disk('local')->get($fileName);

            return view('ver_resultados', compact('contents'));
        } else {
            return redirect()->route('index')->with('error', 'Nenhum resultado encontrado.');
        }
    }
    


    public function exportarResultados(){
        $fileName = 'resultados.csv';
        $contents = Storage::get($fileName); 


        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return new Response($contents, 200, $headers);
    }
}
