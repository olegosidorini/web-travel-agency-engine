<?php
// TODO - вытаскивать контакты из базы
function init_contact (){
  return '
    <div class="wrapper-box module-login">
      <div class="border-top">
        <div class="border-bottom">
          <div class="corner-top-left">
            <div class="corner-top-right">
              <div class="corner-bottom-left">
                <div class="corner-bottom-right">
                  <div class="box-title">
                    <div class="border1-top">
                      <div class="corner1-top-left">
                        <div class="corner1-top-right clear">
                          <h3>КОНТАКТЫ:</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-content">
                    <div class="clear">
                      <p>телефон горячей линии:<br>
                        <span class="telefon">(495) 258-68-91</span>
                        <br><br>
                        <img src="images/anna.gif"  alt="" border="0"><br>
                        Мусоян Наталья<br>
                        <span class="telefon">(499) 978-19-01</span>
                        <br>старший менеджер 
                        <br><br>
                        <img src="images/anna2.gif"  alt="" border="0"><br>
                        Екатерина Карпова<br>
                        <span class="telefon">(499) 973-12-74</span>
                        <br>менеджер отдела<br>Прибалтика и Скандинавия
                        <br><br>филиал в Санкт-Петербурге:<br>
                        <span class="telefon">(812) 327-99-29</span>
                      </p> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  ';
}