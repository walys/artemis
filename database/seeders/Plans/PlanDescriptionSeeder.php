<?php

namespace Database\Seeders\Plans;

use Illuminate\Database\Seeder;
use App\Models\Plans\Plan;
use App\Models\Settings\Language;

class PlanDescriptionSeeder extends Seeder
{
    public function run(): void
    {
        $descriptions = [
            'free' => [
                'pt-BR' => 'Ideal para laboratórios que desejam começar a organizar sua rotina e conhecer os recursos essenciais da plataforma.',
                'en-US' => 'Ideal for laboratories looking to organize their workflow and explore the platform’s essential features.',
                'es-ES' => 'Ideal para laboratorios que desean organizar su rutina y conocer las funciones esenciales de la plataforma.',
            ],

            'start' => [
                'pt-BR' => 'Uma solução para laboratórios em crescimento que precisam de mais recursos para gerenciar suas atividades e otimizar seus processos.',
                'en-US' => 'A solution for growing laboratories that need more resources to manage their activities and optimize their processes.',
                'es-ES' => 'Una solución para laboratorios en crecimiento que necesitan más recursos para gestionar sus actividades y optimizar sus procesos.',
            ],

            'pro' => [
                'pt-BR' => 'Mais controle e produtividade para laboratórios que buscam ampliar sua operação, automatizar processos e gerenciar suas atividades com eficiência.',
                'en-US' => 'More control and productivity for laboratories looking to expand their operations, automate processes and manage activities efficiently.',
                'es-ES' => 'Más control y productividad para laboratorios que buscan ampliar sus operaciones, automatizar procesos y gestionar sus actividades de manera eficiente.',
            ],

            'business' => [
                'pt-BR' => 'Uma solução completa para laboratórios que precisam de maior capacidade operacional, gestão avançada e flexibilidade para crescer.',
                'en-US' => 'A complete solution for laboratories that need greater operational capacity, advanced management and flexibility to grow.',
                'es-ES' => 'Una solución completa para laboratorios que necesitan mayor capacidad operativa, gestión avanzada y flexibilidad para crecer.',
            ],
        ];

        foreach ($descriptions as $planCode => $translations) {
            $plan = Plan::where('code', $planCode)->first();

            if (!$plan) {
                continue;
            }

            foreach ($translations as $languageCode => $description) {
                $language = Language::where('code', $languageCode)->first();

                if (!$language) {
                    continue;
                }

                $plan->descriptions()->updateOrCreate(
                    ['language_id' => $language->id],
                    ['description' => $description]
                );
            }
        }
    }
}
