<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FaisTonFilm') }}</title>

    <?php
        
        function buildSequencePersonnagesOptions($personnages, $selectedPersonnage)
        {
            $result = '';
            foreach ($personnages as $personnage) {
                $checked = trim($personnage) === trim($selectedPersonnage) ? 'selected="selected"' : '';
                $result .= '<option value="' . trim($personnage) . '" ' . $checked . ' >' . trim($personnage) . '</option>';
            }
            return $result;
        }
        
        function getSequencePersonnages($sequence)
        {
            $personnages = [];
        
            foreach ($sequence->dialogues_descriptions as $dialogue) {
                if (isset($dialogue->value->personnage)) {
                    array_push($personnages, $dialogue->value->personnage);
                }
            }
        
            foreach ($sequence->personnages as $personnage) {
                array_push($personnages, $personnage);
            }
        
            return array_unique($personnages);
        }
        
       
        
        ?> 
    <style>
  
            form input {
                text-align: center;
                font-family: 'Ubuntu';
                border: none;
                border-bottom: 2px solid rgba(200, 200, 200, 0.2);
                width: 80%;
                caret-color: #3b3e5e;
            }

            form input:focus {
                outline: none;
                border-bottom: 2px solid rgba(74, 77, 119, 0.541);
            }

            form input:focus::placeholder {
                color: #FFF;
            }

            form input::placeholder {
                color: #000;
                opacity: 1;
            }

        
        @font-face {
            font-family: 'Ubuntu';
            src: url({{ storage_path('fonts/CourierPrime-Regular.ttf') }}) format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Ubuntu';
            src: url({{ storage_path('fonts/CourierPrime-Italic.ttf') }}) format("truetype");
            font-weight: normal;
            font-style: italic;
        }

        @font-face {
            font-family: 'Ubuntu';
            src: url({{ storage_path('fonts/CourierPrime-Bold.ttf') }}) format("truetype");
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Ubuntu';
            src: url({{ storage_path('fonts/CourierPrime-BoldItalic.ttf') }}) format("truetype");
            font-weight: bold;
            font-style: italic;
        }

        @page {
            size: A4 portrait;
            margin: 32px 64px;
            height: 100%;
        }

        .sequence-scenario-container {
            padding: 32px 64px;
        }

        body {
            font-family: 'Ubuntu', sans-serif;
        }

        .page-cover {
            text-align: center;
            height: 100%;
            position: relative;
        }

        .page-cover .title-container {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            height: 100px;

        }

        .titre-film {
            font-size: 30pt;
            font-family: 'Ubuntu', sans-serif;
            text-transform: uppercase;
            margin-bottom: 8px;
            text-align: center;
            letter-spacing: 1px;
        }

        .ecrit-par {
            font-size: 13pt;
            font-family: 'Ubuntu', sans-serif;
        }

        .page-break {
            page-break-after: always;
        }
        table {
            width: 100%;
            height: 80%;
            font-family: 'Ubuntu', sans-serif;
            font-size: 12px;
            border-collapse: collapse;
        }

        table td {
            font-family: 'Ubuntu', sans-serif;
            font-size: 12px;
            border: 1px solid black;
            padding: 10px; /* Adjust the padding as needed */
        }

    </style>

</head>


<body>
    @guest
    @else
    <div class="page-cover">
            <div class="title-container">
           
                <div class="titre-film">{{ $action->titre_oeuvre ?? "Titre de l'oeuvre" }}</div>
            
            </div>
        </div>

        <div style="clear:both;"></div>
        <div class="page-break"></div>
 <div class="page-cover">
            <div class="title-container">
                <div class="titre-film">Introduction</div>
            </div>
        </div>

        <div style="clear:both;"></div>
        <div class="page-break"></div>

        <div style="font-size: 12pt;">

            <div id="scenario-container" class="d-flex flex-column h-100">

                <div id="sequences">

                    @php
                    $data = json_decode($action->introduction);
                 
                    @endphp
               
                  
      
                    <br><br>
                    <table style="width: 100%;">
                 
                 <tr>
                 <td style="width: 30%; height:140px;">
                             <div>Phrase d'accroche</div>
                           
                         </td>
                         <td>
                      {{ $data->phrase ?? '' }}
                         </td>
                     </tr>
                     <tr>
                     <td style="width: 30%; height:140px;">
                             <div>Nom et objectif</div>
 
                         </td>
                         <td>
                            {{ $data->nom ?? '' }}
                         </td>
                     </tr>
                     <tr>
                     <td style="width: 30%; height:140px;">
                             <div>Ton et ambiance </div>
 
                         </td>
                         <td>
                            {{ $data->ton ?? '' }}
                         </td>
                     </tr>
                     <tr>
                     <td style="width: 30%; height:140px;">
                             <div>Public cible</div>
 
                         </td>
                         <td>
                         {{ $data->public ?? '' }}
                         </td>
                     </tr>
                     <tr>
                     <td style="width: 30%; height:140px;">
                             <div>Unicité</div>
 
                         </td>
                         <td>
                        {{ $data->unicité ?? '' }}
                         </td>
                     </tr>
            
 
                 </table>
                 

                   

                </div>
            </div>
        </div>
<div style="clear:both;"></div>

<div class="page-break"></div>
        <div class="page-cover">
                    <div class="title-container">
                        <div class="titre-film">Description du contenu</div>
                    </div>
         </div>

        <div style="clear:both;"></div>
        <div class="page-break"></div>

        <div style="font-size: 12pt;">

            <div id="scenario-container" class="d-flex flex-column h-100">

                <div id="sequences">
                @php
$data = json_decode($action->webtv_description);
@endphp
            
   
      
                    <br><br>
                    <table>
                 
                 <tr>
                         <td>
                             <div>Contenu de la web télé</div>
                           
                         </td>
                         <td>
                           {{ $data->contenu ?? '' }}
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <div>Sujet invités</div>
 
                         </td>
                         <td>
                            {{ $data->sujet ?? '' }}
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <div>Contenue visuel</div>
 
                         </td>
                         <td>
                            {{ $data->visuel ?? '' }}
                         </td>
                     </tr>
                     
                 </table>
                   

                </div>
            </div>
        </div>
<div style="clear:both;"></div>
<div class="page-break"></div>
        <div class="page-cover">
                    <div class="title-container">
                        <div class="titre-film"> Ton et style </div>
                    </div>
         </div>

        <div style="clear:both;"></div>

<div class="page-break"></div>
     <div style="font-size: 12pt;">

                <div id="scenario-container" class="d-flex flex-column h-100">

                    <div id="sequences">

                    @php
$data = json_decode($action->ton_style);
@endphp

                        <br><br>

                        <table>
                 
                 <tr>
                         <td>
                             <div>Le ton</div>
                           
                         </td>
                         <td>
                             {{ $data->ton ?? '' }}
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <div>Le style</div>
 
                         </td>
                         <td>
                             {{ $data->style ?? '' }}
                         </td>
                     </tr>
  
                 </table>



                    </div>
                </div>
            </div>
<div style="clear:both;"></div>


<div class="page-break"></div>
      <div class="page-cover">
            <div class="title-container">
                <div class="titre-film">Structure des épisodes</div>
            </div>
        </div>
<div style="clear:both;"></div>
<div class="page-break"></div>

        <div style="font-size: 12pt;">

            <div id="scenario-container" class="d-flex flex-column h-100">

                <div id="sequences">

                 
               
                   
      
                    <br><br>
                    {{ $action->structure ?? '' }}
                   

                </div>
            </div>
        </div>
<div style="clear:both;"></div>

<div class="page-break"></div>
       <div class="page-cover">
            <div class="title-container">
                <div class="titre-film">Format et durée</div>
            </div>
        </div>
<div style="clear:both;"></div>
<div class="page-break"></div>

        <div style="font-size: 12pt;">

            <div id="scenario-container" class="d-flex flex-column h-100">

                <div id="sequences">

             
               
            
      
                    <br><br>
                    {{ $action->format_durée ?? '' }}
                   

                </div>
            </div>
        </div>
<div style="clear:both;"></div>

@if(!empty($action->scenario))

<div class="page-break"></div>

        <div class="page-cover">
            <div class="title-container">
                <div class="titre-film">Personna</div>
                <div class="ecrit-par">Écrit par : {{ $nom_auteur }}</div>
            </div>
        </div>

<div style="clear:both;"></div>

<div class="page-break"></div>

    <div style="font-size: 12pt;">

     <div id="scenario-container" class="d-flex flex-column h-100">

                <div id="sequences">
                @php
$data = json_decode($action->personna);
@endphp
                <br><br>
                <table>
                 
                 <tr>
                         <td>
                             <div>Nom</div>
                           
                         </td>
                         <td>
                            {{ $data->nom ?? '' }}
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <div>Sexe</div>
 
                         </td>
                         <td>
                {{ $data->sexe ?? '' }}
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <div>Age</div>
                           
                         </td>
                         <td>
                             {{ $data->age ?? '' }}
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <div>Situation géographique</div>
 
                         </td>
                         <td>
                             {{ $data->situation ?? '' }}
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <div>Préparation</div>
                           
                         </td>
                         <td>
                             <textarea name="préparation" class="action-textarea w-100 h-100">{{ $data->préparation ?? '' }}</textarea>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <div>Centres d'intéret</div>
 
                         </td>
                         <td>
                             <textarea name="centre" class="action-textarea w-100 h-100">{{ $data->centre ?? '' }}</textarea>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <div>Problémes</div>
                           
                         </td>
                         <td>
                             <textarea name="probléme" class="action-textarea w-100 h-100">{{ $data->probléme ?? '' }}</textarea>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <div>Objectifs</div>
 
                         </td>
                         <td>
                             <textarea name="objectifs" class="action-textarea w-100 h-100">{{ $data->objectifs ?? '' }}</textarea>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <div>Comportement en ligne</div>
                         </td>
                         <td>
                             <textarea name="comportement" class="action-textarea w-100 h-100">{{ $data->comportement ?? '' }}</textarea>
                         </td>
                     </tr>
 
  
                 </table>

                </div>
            </div>
        </div>
<div style="clear:both;"></div>

<div class="page-break"></div>

        <div class="page-cover">
            <div class="title-container">
                <div class="titre-film">Public cible</div>
            </div>
        </div>

<div style="clear:both;"></div>
<div class="page-break"></div>
         


        <div style="font-size: 12pt;">

            <div id="scenario-container" class="d-flex flex-column h-100">

            @php
$data = json_decode($action->public_cible);
@endphp  
      
                    <br><br>
                    <table>
                 
                <tr>
                        <td>
                            <div>Caracteristiques démographiques</div>
                          
                        </td>
                        <td>
                            <textarea name="caracteristiques" class="action-textarea w-100 h-100">{{ $data->caracteristiques ?? '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>Interet et attentes</div>

                        </td>
                        <td>
                            <textarea name="interet" class="action-textarea w-100 h-100">{{ $data->interet ?? '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>Adaptation du contenu</div>

                        </td>
                        <td>
                            <textarea name="adaptation" class="action-textarea w-100 h-100">{{ $data->adaptation ?? '' }}</textarea>
                        </td>
                    </tr>
 
                </table>
                
                    
                   

       
            </div>
        </div>

<div style="clear:both;"></div>
@endif


  <div class="page-break"></div>

<div class="page-cover">
    <div class="title-container">
        <div class="titre-film">Diffusion et promotion</div>

    </div>
</div>

<div style="clear:both;"></div>
<div class="page-break"></div>

        <div style="font-size: 12pt;">


<div id="scenario-container" class="d-flex flex-column h-100">

    <div id="sequences">
        <br><br>
        <table>
        @php
        $data = json_decode($action->diffusion);
        @endphp   
                <tr>
                        <td>
                            <div>La diffusion </div>
                          
                        </td>
                        <td>
                            <textarea name="diffusion" class="action-textarea w-100 h-100"> {{ $data->diffusion ?? '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>La promotion</div>

                        </td>
                        <td>
                            <textarea name="promotion" class="action-textarea w-100 h-100"> {{ $data->promotion ?? '' }}</textarea>
                        </td>
                    </tr>
                    
 
                </table>

    </div>
</div>
<div style="clear:both;"></div>
<div class="page-break"></div>
    
<div style="font-size: 12pt;">
<div id="scenario-container" class="d-flex flex-column h-100">

                <div id="sequences">

                    <br><br>
                    {{ $action->conclusion ?? '' }}
            </div>
        </div>
<div style="clear:both;"></div>
<div class="page-break"></div>
    <script type="text/php">
            if ( isset($pdf) ) {
                $pdf->page_script('
                    $page_number = $pdf->get_page_number();
                    if($PAGE_NUM > 1){
                        $pdf->text(820, 520, "Page ".($PAGE_NUM-1)."/".($PAGE_COUNT-1), "Ubuntu", 12, array(0,0,0));
                    }
                ');
            }
    </script>
 @endguest

</body>

</html>