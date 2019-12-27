<section class="mt-2">

	<div class="page-title">
		<h2>Кредитный калькулятор</h2>
	</div>

	<div class="row justify-content-center">
		<div class="col-12 credit-calculator">

			<form>
				<div class="row justify-content-center credit-calculator-line">
					<div class="col-4 col-md-3 credit-calculator-term">
						<p>Сумма кредитования</p>
					</div>
					<div class="col-8 col-md-6 credit-calculator-input">
						<input onchange="you('rub_loan_amount')" placeholder="100000 ₽" type="text" id="rub_loan_amount" class="
						input-symbol-euro width-input rub_loan_amount" name="rub_loan_amount">
						<input type="text" style="display: none;" id="loan_amount" class="loan_amount" name="loan_amount">
					</div>

				</div>
				<div class="row justify-content-center credit-calculator-line">
					<div class="col-4 col-md-3 credit-calculator-term">
						<p class="credit-term">Срок</p>
					</div>
					<div class="col-8 col-md-6 credit-calculator-input">
						<input type="text" name="credit_term" class="width-input-small" id="srok_credita">
						<select name="select_credit_term" class="width-select" id="select_srok_credita">
							<option value="12">лет</option>
							<option value="1">месяцев</option>
							
						</select>
					</div>
				</div>
				<div class="row justify-content-center credit-calculator-line">
					<div class="col-4 col-md-3 credit-calculator-term">
						<p>Дата начала выплат</p>
					</div>
					<div class="col-8 col-md-6 credit-calculator-input">
						<input type="date" class="width-input" id="date_start" name="payment_start_date">
					</div>
				</div>
				<div class="row justify-content-center credit-calculator-line interest-rate">
					<div class="col-4 col-md-3 credit-calculator-term">
						<p>Процентная ставка</p>
					</div>
					<div class="col-8 col-md-6 credit-calculator-input">
						<!--<select name="select_interest_rate" >
							<option value="fixed">фиксированная</option>
							<option value="variable">переменная</option>
						</select>-->
						<input type="text" name="interest_rate" id="procentnaya_stavka" class="width-input-small">
						<select name="select_interest_rate_procent" id="select_interest_rate_procent" class="width-select">
							<option value="0.0833333333">% в год</option>
							<option value="1">% в месяц</option>

						</select>
					</div>
				</div>
				<div class="row justify-content-center credit-calculator-line">
					<div class="col-4 col-md-3 credit-calculator-term">
						<p>Количество иждивенцев</p>
					</div>
					<div class="col-8 col-md-2 credit-calculator-input">
						<input type="text" class="width-input-small" value="0" name="number_dependents">
					</div>
					<div class="col-12 col-md-4 credit-calculator-input credit-calculator-input-current-loans">
						<div class="row">
							<div class="col-4 col-md-7">
								<span class="current-loans">Текущие кредиты</span>
							</div>
							<div class="col-8 col-md-5">
								<input type="text" class="rub_current_loans" id="rub_current_loans" name="rub_current_loans">
								<input type="text" style="display: none;" class="current_loans" id="current_loans" name="current_loans">
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center credit-calculator-line without-guarantor">
					<div class="col-4 col-md-3 credit-calculator-term">
						<p>Без поручителя</p>
					</div>
					<div class="col-8 col-md-6 credit-calculator-input">
						<label class="credit-calculator-checkbox">
							<input type="checkbox" name="without_guarantor">
							<span class="checkmark"></span>
						</label>
					</div>
				</div>
			</form>

			<div class="row justify-content-center">
				<div class="col-12 col-md-10 credit-calculator-result">
					<div class="row justify-content-center credit-calculator-result-line">
						<div class="col-6 col-md-4 credit-calculator-result-text">
							<p>Примерный ежемесячный платеж</p>
						</div>
						<div class="col-6 col-md-6 credit-calculator-result-number">
							<p id="approximate-monthly-payment"></p>
						</div>
					</div>
					<div class="row justify-content-center credit-calculator-result-line">
						<div class="col-6 col-md-4 credit-calculator-result-text">
							<p>Всего платежей</p>
						</div>
						<div class="col-6 col-md-6 credit-calculator-result-number">
							<p id="total-payments"></p>
						</div>
					</div>
					<div class="row justify-content-center credit-calculator-result-line">
						<div class="col-6 col-md-4 credit-calculator-result-text">
							<p>Переплата</p>
						</div>
						<div class="col-6 col-md-6 credit-calculator-result-number">
							<p id="overpayment"></p>
						</div>
					</div>
					<div class="row justify-content-center credit-calculator-result-line">
						<div class="col-6 col-md-4 credit-calculator-result-text">
							<p>Необходимо подтвердить доход</p>
						</div>
						<div class="col-6 col-md-6 credit-calculator-result-number">
							<p id="must-confirm-income"></p>
						</div>
					</div>
				</div>
			</div>

			<div class="row justify-content-center btn-credit-calculator-result-line">
				<div class="col-12 col-md-3">
					<p class="btn-news-all">
						<a class="btn btn-outline btn-credit-calculator-result" onclick="calculatorResult()">
							Рассчитать
						</a>
					</p>
				</div>
			</div>

		</div>
	</div>

</section>

<section id="calculator-result" class="mt-2" style="display: none;">

	<div class="row justify-content-center result-calculation">

		<div class="col-12 result-calculation-title">
			<p>Результат расчета</p>
		</div>

		<div class="col-6 result-calculation-text">
			<p>Сумма платежа в месяц</p>
		</div>
		<div class="col-6 result-calculation-sum">
			<p id="sum_platezh">1 472 418,32...7 054 233,74</p>
		</div>

		<div class="col-6 result-calculation-text">
			<p >Всего платежей</p>
		</div>
		<div class="col-6 result-calculation-sum">
			<p id="vsego_platezh">170 174 651,36</p>
		</div>

		<div id="table-graf" name="table-graf" style="width: 100%;">

			<table class="result-calculation-table" id="table2excel" style="width: 100%;">
				<thead>
					<tr>
						<th>
							№
						</th>
						<th>
							Дата
						</th>
						<th>
							Сумма платежа
						</th>
						<th>
							Погашение основного долга
						</th>
						<th>
							Выплата процентов
						</th>
						<th>
							Остаток
						</th>
						<th>
							Описание
						</th>
					</tr>
				</thead>
				<tbody id="table_body">

				</tbody>
				<tbody style="display: none;" id="table_hide">

				</tbody>
			</table>
			<br>
			<div style="width: 100%;">
			<p id="btn-read-more-table-show" class="btn-news-all text-center">
				<a class="btn btn-outline btn-benefits" onclick="display_all_benefits();return false;">Смотреть полностью
				</a>
			</p>
			<p id="btn-read-more-table-hide" style="display: none" class="btn-news-all text-center">
				<a href="#table-graf" class="btn btn-outline btn-benefits" onclick="display_all_benefits_hide();return false;">Свернуть
				</a>
			</p>
		</div>
		<script>
			function display_all_benefits_hide()
			{
				$('#table_body').show();
				$('#table_hide').hide();
				$('#btn-read-more-table-show').show();
				$('#btn-read-more-table-hide').hide();
				// сперва получаем позицию элемента относительно документа
				var scrollTop = $('#table-graf').offset().top;

				// скроллим страницу на значение равное позиции элемента
				$(document).scrollTop(scrollTop);
			}
			function display_all_benefits()
			{
				$('#table_body').hide();
				$('#table_hide').show();
				$('#btn-read-more-table-show').hide();
				$('#btn-read-more-table-hide').show();
				
			}
		</script>
		</div>
		<div class="col-12">
			<div class="row justify-content-center btn-credit-calculator-result-line">
				<div class="col-12 col-md-3">
					<p class="btn-news-all">
						<a  id="bt" class="btn  btn-outline btn-credit-calculator-result">
							Скачать в Excel
						</a>
					</p>
				</div>
				<div class="col-12 col-md-4">
					<p class="btn-news-all">
						<a href="#" class="btn btn-outline btn-credit-calculator-result js-show-credit_calcul">
							Отправить себе на почту
						</a>
					</p>
				</div>
			</div>
		</div>

	</div>

</section>

<section class="first-person-section on-company mt-2">
	<div class="page-title">
		<h2>Менеджмент</h2>
	</div>
	<div class="page-content-paper">
		<div class="row items-row">
			<div class="news-list-item firstperson col-12 col-md-6 col-lg-4 col-xl-4">
				<div class=" news-item-content">
					<p class="firstperson-image"><img src="/upload/iblock/2c3/2c358d1fc2a54e4c52910c19537008fd.png" alt="Иванова Мария Олеговна" width="100%"></p>
					<div class="news-item-title">Иванова Мария Олеговна</div>
					<p class="news-item-description">Директор департамента розничных продаж</p>
					<p class="firstperson-phone">(812) 456-58-64</p>
					<p class="firstperson-email">ivanova-mo@bjr-bank.ru</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="our-partners mt-2">

	<div class="page-title">
		<h2>Наши партнеры</h2>
	</div>

	<div class="row">
		<h3>Банки</h3>
	</div>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"room-partners",
		Array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_ADDITIONAL" => "partner_stroy",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "N",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_NOTES" => "",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_DATE" => "N",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "N",
			"DISPLAY_PREVIEW_TEXT" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array("", ""),
			"FILTER_NAME" => "",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "31",
			"IBLOCK_TYPE" => "news",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "N",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "5",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "Y",
			"PAGER_SHOW_ALWAYS" => "Y",
			"PAGER_TEMPLATE" => "room-navigation",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array("", "POSITION", "TAGS", "THEME", "BACKGROUND", "TEXT_COLOR", ""),
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "SORT",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N"
		)
	);?>

</section>

</div>
<input type="text" id="mes_start" style="display: none">
<input type="text" id="year_start" style="display: none">
<script>
	$(document).ready(function () {

		var $frModalSignupConsultation = $('.fr-modal-overlay[data-attr="signup-consultation"]');
		$('.js-show-signup-consultation').on('click', function(e) {
			e.preventDefault();
			$frModalSignupConsultation.addClass('in');
			$('input[name="TYPE"]').val($(this).attr('topic-letter'));
			$('body').addClass('has-modal');
		});
		$('.owl-carousel').show();
		$('.arrow-lending-terms').show();
		$('#lending-terms-item-title').text('Квартира');
		$('#lending-terms-item-loan').text('3-35 лет');
		$('#lending-terms-item-down-payment').text('от 0%');
		$('#lending-terms-item-average-rate').text('от 9,7% (средняя 10,5%)');
		$('input[name=interest_rate]').val('9.7');

	});



	$(document).on('change', 'select[name=lending-terms]', function() {
		$('.owl-carousel').show();
		$('.arrow-lending-terms').show();
		if ($(this).val() == 'apartment') 
		{
			$('#lending-terms-item-title').text('Квартира');
			$('#lending-terms-item-loan').text('3-35 лет');
			$('#lending-terms-item-down-payment').text('от 0%');
			$('#lending-terms-item-average-rate').text('от 9,7% (средняя 10,5%)');
			$('input[name=interest_rate]').val('9.7');
		}				
		else if ($(this).val() == 'room') 
		{
			$('#lending-terms-item-title').text('Комната');
			$('#lending-terms-item-loan').text('3-35 лет');
			$('#lending-terms-item-down-payment').text('от 15%');
			$('#lending-terms-item-average-rate').text('12% (средняя 11,5%)');
			$('input[name=interest_rate]').val('12');
		}
		else if ($(this).val() == 'redemption-share-apartment') 
		{
			$('#lending-terms-item-title').text('Выкуп доли в квартире');
			$('#lending-terms-item-loan').text('3-35 лет');
			$('#lending-terms-item-down-payment').text('от 15%');
			$('#lending-terms-item-average-rate').text('12% (средняя 11,5%)');
			$('input[name=interest_rate]').val('12');
		}
		else if ($(this).val() == 'negotiation') 
		{
			$('#lending-terms-item-title').text('Переуступка');
			$('#lending-terms-item-loan').text('3-35 лет');
			$('#lending-terms-item-down-payment').text('от 0%');
			$('#lending-terms-item-average-rate').text('от 6% (средняя 10,5%)');
			$('input[name=interest_rate]').val('6');
		}
		else if ($(this).val() == 'new-building') 
		{
			$('#lending-terms-item-title').text('Новостройка');
			$('#lending-terms-item-loan').text('3-35 лет');
			$('#lending-terms-item-down-payment').text('от 0%');
			$('#lending-terms-item-average-rate').text('от 6% (средняя 10,5%)');
			$('input[name=interest_rate]').val('6');
		}
		else if ($(this).val() == 'transition-from-installment') 
		{
			$('#lending-terms-item-title').text('Переход с рассрочки от застройщика на ипотечное кредитование');
			$('#lending-terms-item-loan').text('3-35 лет');
			$('#lending-terms-item-down-payment').text('от 0%');
			$('#lending-terms-item-average-rate').text('от 6% (средняя 10,5%)');
			$('input[name=interest_rate]').val('6');
		}
		else if ($(this).val() == 'cnt-dnp') 
		{
			$('#lending-terms-item-title').text('СНТ/днп');
			$('#lending-terms-item-loan').text('3-35 лет');
			$('#lending-terms-item-down-payment').text('от 25%');
			$('#lending-terms-item-average-rate').text('от 11,2% (средняя 11,85%)');
			$('input[name=interest_rate]').val('11.2');
		}
		else if ($(this).val() == 'izhs') 
		{
			$('#lending-terms-item-title').text('ИЖС');
			$('#lending-terms-item-loan').text('3-35 лет');
			$('#lending-terms-item-down-payment').text('от 15%');
			$('#lending-terms-item-average-rate').text('от 11% (средняя 11,75%)');
			$('input[name=interest_rate]').val('11');
		}
		else if ($(this).val() == 'lph') 
		{
			$('#lending-terms-item-title').text('ЛПХ');
			$('#lending-terms-item-loan').text('3-35 лет');
			$('#lending-terms-item-down-payment').text('от 15%');
			$('#lending-terms-item-average-rate').text('от 11% (средняя 11,75%)');
			$('input[name=interest_rate]').val('11');
		}
		else if ($(this).val() == 'agricultural-destination') 
		{
			$('#lending-terms-item-title').text('Сельхоз назначения');
			$('#lending-terms-item-loan').text('3-35 лет');
			$('#lending-terms-item-down-payment').text('от 25%');
			$('#lending-terms-item-average-rate').text('от 11,2% (средняя 11,85%)');
			$('input[name=interest_rate]').val('11.2');
		}
		else if ($(this).val() == 'urban-land') 
		{
			$('#lending-terms-item-title').text('Земли городских поселений');
			$('#lending-terms-item-loan').text('3-35 лет');
			$('#lending-terms-item-down-payment').text('от 15%');
			$('#lending-terms-item-average-rate').text('от 11% (средняя 11,75%)');
			$('input[name=interest_rate]').val('11');
		}
	});

	function round(value, decimals) {
		return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
	}
	function number_format(number, decimals, dec_point, thousands_sep) {
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
			var k = Math.pow(10, prec);
			return '' + (Math.round(n * k) / k)
			.toFixed(prec);
		};
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
  .split('.');
  if (s[0].length > 3) {
  	s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
  	.length < prec) {
  	s[1] = s[1] || '';
  s[1] += new Array(prec - s[1].length + 1)
  .join('0');
}
return s.join(dec);
}
function div(val, by){
	return (val - val % by) / by;
}

function calculatorResult() {
	var loan_amount = $('input[name=loan_amount]').val();
	var credit_term = $('input[name=credit_term]').val();
	var select_credit_term = $('select[name=select_credit_term]').val();
	var payment_start_date = $('input[name=payment_start_date]').val();
	var interest_rate = $('input[name=interest_rate]').val();
	var select_interest_rate_procent = $('select[name=select_interest_rate_procent]').val();
	var number_dependents = $('input[name=number_dependents]').val();
	var current_loans = $('input[name=current_loans]').val();
	var percent = interest_rate * 0.01;
	var interest_rate = percent * select_interest_rate_procent;
	var number_regular_payments = credit_term * select_credit_term
	var k = (interest_rate+((interest_rate)/(Math.pow((1+interest_rate), number_regular_payments)-1)));
	var payment = round((k * loan_amount), 0);
	var total_payments = round((number_regular_payments * payment), 0);
	var overpayment = round((total_payments - loan_amount), 0);

	number_dependents = parseInt(number_dependents);
	if (current_loans > 0 & number_dependents > 0)
	{
		var income = round((payment * 2 + (payment * 2*number_dependents) + 2*current_loans), 0);
	}
	else
	{
		if (number_dependents > 0)
		{
			var income = round((payment * 2 + (payment * 2*number_dependents)), 0);
		}
		else
		{
			if ( current_loans > 0)
			{
				var income = round((payment * 2 + 2*current_loans), 0);
			}
			else
			{
				var income = round((payment * 2), 0);
			}
		}
	}
	var date_start = document.getElementById("date_start").value;

	if (payment > 0 & total_payments > 0 & overpayment > 0 & income > 0 & date_start !== "") 
	{

		$("#calculator-result").show();
			$('#approximate-monthly-payment').html(number_format(payment, 0, ',', ' ') + ' ₽');
			$('#total-payments').html(number_format(total_payments, 0, ',', ' ') + ' ₽');
			$('#overpayment').html(number_format(overpayment, 0, ',', ' ') + ' ₽');
			$('#must-confirm-income').html(number_format(income, 0, ',', ' ') + ' ₽');

			//table
			$('#sum_platezh').html(number_format(payment, 0, ',', ' ') + ' ₽');
			$('#vsego_platezh').html(number_format(total_payments, 0, ',', ' ') + ' ₽');

			//table_body
			var mes = total_payments/payment;
			var i = 0;
			var table_body_content = '';
			while (i < mes)
			{
				//number
				var tr = '<tr>';
				var number = tr + '<td data-label="№">';
				number = number + (i+1);
				number = number + '</td>';

				//date
				var date = '<td data-label="Дата">';
				var mod_date_year = date_start.charAt(0) + date_start.charAt(1) + date_start.charAt(2) + date_start.charAt(3);
				var mod_date_month = date_start.charAt(5) + date_start.charAt(6);
				var mod_date_day = date_start.charAt(8) + date_start.charAt(9);
				$("mes_start").text(mod_date_month);
				$("year_start").text(mod_date_year);

				if ((i+parseInt(mod_date_month)) <= 12)
				{
					mod_date_month = parseInt(mod_date_month) + i;
				}
				else
				{

					var d = parseInt(mod_date_month) + i;
					mod_date_year = parseInt(mod_date_year) + div(d,12);
					mod_date_month = (parseInt(mod_date_month) + i) - (div(d,12)*12);
					if(mod_date_month == 0)
					{
						mod_date_month = 12;
						mod_date_year = mod_date_year - 1;
					}
				}
				date = date + mod_date_day + '.' + mod_date_month + '.' + mod_date_year;
				date = date + '</td>';

				//sum
				var summa = '<td data-label="Сумма">';
				var ss = parseInt(payment);
				summa = summa + number_format(ss, 0, ',', ' ') + ' ₽';
				summa = summa + '</td>';

				//pogash
				var pogash = '<td data-label="Погашение основного долга">';
				var summdolg = loan_amount;
				var k;
				var pay_proc = summdolg*interest_rate;//текущая выплата 2500 +++++
				var tek_summa = parseInt(pay_proc)+parseInt(summdolg);//сумма долга с процентами на первую выплату
				var ostatok = tek_summa - parseInt(payment);//остаток

				if (i > 0)
				{
					for (k=1;k<=i; k++)
					{
						pay_proc = ostatok*interest_rate;
						tek_summa = pay_proc + ostatok;
						ostatok = tek_summa - parseInt(payment);
					}
				}
				var proc_r = pay_proc;
				if (proc_r >= 0)
				{
					var pog = (parseInt(payment) - proc_r);
				}
				else
				{
					var pog = parseInt(payment);
				}
				pogash = pogash + number_format(pog, 0, ',', ' ') + ' ₽';
				pogash = pogash + '</td>';

				//procent
				var procent = '<td data-label="Выплата процентов">';

				if (proc_r >= 0)
				{
					procent = procent + number_format(proc_r, 0, ',', ' ') + ' ₽';
				}
				else
				{
					//procent = procent + '0 ₽';
					procent = procent + number_format(proc_r, 0, ',', ' ') + ' ₽';
				}	
				procent = procent + '</td>';

				//ost
				var ost = '<td data-label="Остаток">';
				var tp_ost = parseInt(total_payments) - parseInt(payment)*(i+1);
				ost = ost + number_format(tp_ost, 0, ',', ' ') + ' ₽';
				ost = ost + '</td>';

				//description
				var description = '<td data-label="Описание">';
				description = description + 'Ежемесячный платеж ';
				description = description + 'за ' + mod_date_month + '/' + mod_date_year;
				description = description + '</td>';
				var result = number + date + summa  + pogash + procent + ost  + description ;
				result = result + '</tr>'
				if (i < 3) 
				{
					var	table_body_content_show = table_body_content + result;
					$('#table_body').hide();
					$('#table_hide').show();
					$('#btn-read-more-table').hide();

				}
				else
				{
					$('#table_body').show();
					$('#table_hide').hide();
					$('#btn-read-more-table-show').show();
				}
				table_body_content = table_body_content + result;
				i++;
			}		
			$('#table_body').html(table_body_content_show);
			$('#table_hide').html(table_body_content);
		} 
		else 
		{
			if (date_start == "")
			{
				alert('Выберите дату начала выплат');
			}
			else 
			{
				alert('Заполните форму калькулятора');
			}	
		}
	}

	function addRub (val) 
	{
		return val;
	}

	function removeRub (val) 
	{
		val = val.replace(" ₽", "");
		val = val.replace("₽", "");
		val = val.replace(" ", "");

		return val;
	}
		function you (id)
	{
		var content_id = document.getElementById(id).value;
		document.getElementById(id).value = content_id + " ₽";
	
	}
	$(".rub_loan_amount").on("input", function () 
	{
		
		var $this = $(this);
		var val = $this.prop("value");
		var newVal = removeRub(val);
		var str = document.getElementById('rub_loan_amount').value;
		var str = str.replace(/[^0-9]/gim, "");
		document.getElementById('loan_amount').value = str;
		newVal = addRub(newVal);
		$this.prop("value", newVal);
	});
	$(".rub_current_loans").on("input", function () 
	{
		
		var $this = $(this);
		var val = $this.prop("value");
		var newVal = removeRub(val);
		var str = document.getElementById('rub_current_loans').value;
		var str = str.replace(/[^0-9]/gim, "");
		document.getElementById('current_loans').value = str;

		newVal = addRub(newVal);
		$this.prop("value", newVal);
	});			


</script>
<script>
	$('#bt').click(function () {
		$("#table2excel").table2excel({
			filename: "credit.xls"
		});
	});

</script>