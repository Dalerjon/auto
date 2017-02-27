function CheckFields(form)
{
	 var myTextField = document.getElementById('insp');
	 massege = "Заполните поле:";
	 massege2="должен состоять из цифр 0-9";
	 massege3="не более 4 символов";
	 massege4="Поле:"
	if(form.volume.value == ''  )
	{
		massege+=' \'Обьем двигателя\' ';
		log1=true;
	}
	if(! (/^[0-9]+$/.test(form.volume.value))){
		massege2=' \'Обьем двигателя\' '+massege2;
		log2=true;
		}
	if( form.volume.length < 4 )
	{

		massege3= '\'Обьем двигателя\'' + massege3;
		log2=true;
	}
	if(form.price.value == '')
	{
		
		massege+='\'Цена, долл\''
		log1=true;
	}
	if(! (/^[0-9]+$/.test(form.price.value))){
		
		massege2='\'Цена, долл\'' +massege2;
		log2=true;
	}
	if(form.run.value =='')
	{
		
		massege+='\'Пробег, км\''
		log1=true;
	}
	if(! (/^[0-9]+$/.test(form.run.value))){

		massege2='\'Пробег , км  \''+massege2;
		log2=true;
	}
	if(form.powwer.value == '')
	{
		
		massege+='\'Мощность, лш\''
		log1=true;
	}
	if(! (/^[0-9]+$/.test(form.powwer.value))){
	
		massege2='\'Мощность, лш \' '+massege2;
		log2=true;
	}
	massege4=massege4+massege2
	if(log1==true && log2==true && log3==true)
	{
	alert(massege + massege4 + massege3);
	}
	else if(log1==true && log2==true )
	{
	alert(massege + massege4);
	}
	else if(log1==true && log3==true )
	{
	alert(massege + massege3);
	}
	else if(log2==true && log3==true )
	{
	alert(massege3 + massege4);
	}
	else (log1==true)
	{
	alert(massege);
	}
	
	
	
}