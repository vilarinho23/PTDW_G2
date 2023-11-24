<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cursos a inserir
        $cursos = [
            'MI' => 'CTeSP DE MANUTENÇÃO INDUSTRIAL',
            'PSI' => 'CTeSP DE PROGRAMAÇÃO DE SISTEMAS DE INFORMAÇÃO',
            'RSI' => 'CTeSP DE REDES E SISTEMAS INFORMÁTICOS',
            'TM' => 'CTeSP DE TECNOLOGIA MECÂNICA',
            'CS' => 'CTeSP EM CIBERSEGURANÇA',
            'GPME' => 'CTeSP EM GESTÃO DE PME',
            'IEA' => 'CTeSP EM INSTALAÇÕES ELÉTRICAS E AUTOMAÇÃO',
            'MQI' => 'CTeSP EM METROLOGIA E QUALIDADE NA INDÚSTRIA',
            'CE-ASIG' => 'CURSO DE ESPECIALIZAÇÃO EM AUDITORIAS DE SISTEMAS INTEGRADOS DE GESTÃO',
            'CE-DIA' => 'CURSO DE ESPECIALIZAÇÃO EM DADOS E INTELIGÊNCIA ARTIFICIAL',
            'CE-DAM' => 'CURSO DE ESPECIALIZAÇÃO EM DESENVOLVIMENTO DE APLICAÇÕES MÓVEIS',
            'CE-EO' => 'CURSO DE ESPECIALIZAÇÃO EM EXCELÊNCIA NAS ORGANIZAÇÕES',
            'CE-GNR' => 'CURSO DE ESPECIALIZAÇÃO EM GESTÃO DE NEGÓCIOS DE RETALHO',
            'EMI' => 'LICENCIATURA EM ELETRÓNICA E MECÂNICA INDUSTRIAL',
            'GC' => 'LICENCIATURA EM GESTÃO COMERCIAL',
            'GQ' => 'LICENCIATURA EM GESTÃO DA QUALIDADE',
            'GP' => 'LICENCIATURA EM GESTÃO PÚBLICA',
            'SCE' => 'LICENCIATURA EM SECRETARIADO E COMUNICAÇÃO EMPRESARIAL',
            'TI' => 'LICENCIATURA EM TECNOLOGIAS DA INFORMAÇÃO',
            'MADCO' => 'MESTRADO EM ASSESSORIA DE DIREÇÃO E COMUNICAÇÃO NAS ORGANIZAÇÕES',
            'MGC' => 'MESTRADO EM GESTÃO COMERCIAL',
            'MGQT' => 'MESTRADO EM GESTÃO DA QUALIDADE TOTAL',
            'MGND' => 'MESTRADO EM GESTÃO E NEGÓCIOS DIGITAIS',
            'MIA' => 'MESTRADO EM INFORMÁTICA APLICADA'
        ];

        // Inserir cursos
        foreach ($cursos as $acron => $nome) {
            $curso = [
                'acron_curso' => $acron,
                'nome_curso' => $nome
            ];

            Curso::firstOrCreate($curso);
        }
    }
}
