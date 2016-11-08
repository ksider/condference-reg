<div class="hide">
    [text namefio id:namefio]
    [email email id:email]
    [text phone id:phone]
    [text work id:work]
    
    [text pid id:pid]
</div>
   

<div class="fotmline">
    <label for="">Название</label>
    [text workname placeholder "Название доклада"]
</div>

<div class="fotmline">
    
 <div class="rep_type-head">Тип доклада: </div>    
    <div class="report_type">
[radio type default:1 use_label_element "Устный" "Стендовый"]
    </div>
    
</div>

<div class="fotmline">

<label>Раздел</label>
	   
[select themes "Механика гетерогенных и адаптивных материалов, композитов и конструкций"  "Аэро-, гидромеханика и реология структурно сложных сред " "Проблемы горения и детонации сложных сред" "Вычислительные методы механики гетерогенных сред" "Биомеханика" "Школа молодых ученых"]   
    
</div>

<div class="fotmline">
    <label for="">Аннотация:</label>
    [textarea abstract class:abstr placeholder "Аннотация"]
</div>
<div class="fotmline">
    <label for="">Файл доклада</label>
[file file filetypes:doc|docx|otf|zip limit:10mb]
Перенесите файл сюда или кликните, размер не должен превышать 5Мб<br>поддерживаются файлы с расширениями .doc, .docx, .otf
</div>

<div class="reg-sub center">
[submit]
</div>