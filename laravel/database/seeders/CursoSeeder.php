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
        $nomes_cursos = [
            'CTeSP DE MANUTENÇÃO INDUSTRIAL',
            'CTeSP DE PROGRAMAÇÃO DE SISTEMAS DE INFORMAÇÃO',
            'CTeSP DE REDES E SISTEMAS INFORMÁTICOS',
            'CTeSP DE TECNOLOGIA MECÂNICA',
            'CTeSP EM CIBERSEGURANÇA',
            'CTeSP EM GESTÃO DE PME',
            'CTeSP EM INSTALAÇÕES ELÉTRICAS E AUTOMAÇÃO',
            'CTeSP EM METROLOGIA E QUALIDADE NA INDÚSTRIA',
            'CURSO DE ESPECIALIZAÇÃO EM AUDITORIAS DE SISTEMAS INTEGRADOS DE GESTÃO',
            'CURSO DE ESPECIALIZAÇÃO EM DADOS E INTELIGÊNCIA ARTIFICIAL',
            'CURSO DE ESPECIALIZAÇÃO EM DESENVOLVIMENTO DE APLICAÇÕES MÓVEIS',
            'CURSO DE ESPECIALIZAÇÃO EM EXCELÊNCIA NAS ORGANIZAÇÕES',
            'CURSO DE ESPECIALIZAÇÃO EM GESTÃO DE NEGÓCIOS DE RETALHO',
            'LICENCIATURA EM ELETRÓNICA E MECÂNICA INDUSTRIAL',
            'LICENCIATURA EM GESTÃO COMERCIAL',
            'LICENCIATURA EM GESTÃO DA QUALIDADE',
            'LICENCIATURA EM GESTÃO PÚBLICA',
            'LICENCIATURA EM SECRETARIADO E COMUNICAÇÃO EMPRESARIAL',
            'LICENCIATURA EM TECNOLOGIAS DA INFORMAÇÃO',
            'MESTRADO EM ASSESSORIA DE DIREÇÃO E COMUNICAÇÃO NAS ORGANIZAÇÕES',
            'MESTRADO EM GESTÃO COMERCIAL',
            'MESTRADO EM GESTÃO DA QUALIDADE TOTAL',
            'MESTRADO EM GESTÃO E NEGÓCIOS DIGITAIS',
            'MESTRADO EM INFORMÁTICA APLICADA'
        ];

        foreach ($nomes_cursos as $nc)
        {
            Curso::firstOrCreate([
                'nome_curso' => $nc,
            ]);
        }
    }
}
