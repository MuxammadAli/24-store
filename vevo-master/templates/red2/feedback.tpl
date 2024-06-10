<div class="full-story">  
  <div class="post-title"><h1>Обратная связь</h1></div>
   <div>Написать сообщение администратору</div>
    <table class="fulltable" cellspacing="0" border="0">
     [not-logged]
     <tr>
      <td class="sline"><b>Ваше имя:</b> <span class="import">*</span></td>
      <td><input class="input3" maxlength="35" name="name" size="14"/></td>
     </tr>
     <tr>
      <td class="sline"><b>E-Mail:</b> <span class="import">*</span></td>
      <td><input class="input3" maxlength="35" name="email" size="14"/></td>
     </tr>
     [/not-logged]
     <tr>
      <td class="sline"><b>Заголовок:</b> <span class="import">*</span></td>
      <td><input class="input3"  maxlength="35" name="subject" size="14" /></td>
     </tr>
     <tr>
      <td class="sline"><b>Получатель:</b> <span class="import">*</span></td>
      <td>{recipient}</td>
     </tr>
     <tr>
      <td class="sline"><b>Сообщение:</b></td>
      <td><textarea style="font-family: Arial, Helvetica, sans-serif; font-size:12px;  width:350px;height:100px;" name="message" rows="" cols=""></textarea></td>
     </tr>
     [sec_code]
     <tr>
      <td class="sline"><b>Код:</b></td>
      <td>{code}</td>
     </tr>
     <tr>
      <td class="sline"><b>Введите код:</b></td>
      <td><input class="input3" maxlength="45" name="sec_code" size="14"/></td>
     </tr>
     [/sec_code]
     [recaptcha]
     <tr>
      <td class="sline"><b>Введите два слова, показанных на изображении:</b></td>
      <td>{recaptcha}</td>
     </tr>
     [/recaptcha]
     [question]
     <tr>
      <td class="sline"><b>Вопрос:</b></td>
      <td>{question}</td>
     </tr>
     <tr>
      <td class="sline"><b>Ответ:</b></td>
      <td><input type="text" name="question_answer" id="question_answer" class="f_input" /></td>
     </tr>
     [/question]
     <tr>
      <td colspan="2"><input name="send_btn" class="votebutton" type="submit" value="Отправить"/></td>
     </tr>
    </table>
</div>