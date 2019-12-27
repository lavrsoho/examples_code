
<section class="mt-2 section-lending-terms">

	<div class="page-title">
		<h2>Условия кредитования</h2>
	</div>

	<div class="row justify-content-center">
		<div class="col-12 lending-terms">
			<select name="lending-terms" class="lending-terms">
				<!--<option value="" selected disabled hidden>Выберите объект кредитования</option>-->
				<optgroup label="Квартира">
					<option selected value="apartment">Квартира</option>
					<option value="room">Комната</option>
					<option value="redemption-share-apartment">Выкуп доли в квартире</option>
					<option value="negotiation">Переуступка</option>
					<option value="new-building">Новостройка</option>
					<option value="transition-from-installment">Переход с рассрочки <br>от застройщика на <br>ипотечное кредитование</option>
				</optgroup>
				<optgroup label="Частный дом">
					<option value="cnt-dnp">СНТ/днп</option>
					<option value="izhs">ИЖС</option>
					<option value="lph">ЛПХ</option>
				</optgroup>
				<optgroup label="Земельный участок">
					<option value="agricultural-destination">Сельхоз назначения</option>
					<option value="urban-land">Земли городских поселений</option>
				</optgroup>
			</select>
			<div class="row justify-content-center">
				<div class="col-12 col-md-9 owl-carousel owl-carousel-terms">

					<div class="lending-terms-item">
						<h3 id="lending-terms-item-title">Квартира</h3>
						<hr>
						<div class="row justify-content-center">
							<div class="col-6 col-md-3 lending-terms-item-left">
								<p>срок</p>
							</div>
							<div class="col-6 col-md-5 lending-terms-item-right">
								<p id="lending-terms-item-loan">3-35 лет</p>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-6 col-md-3 lending-terms-item-left">
								<p>первый взнос</p>
							</div>
							<div class="col-6 col-md-5 lending-terms-item-right">
								<p id="lending-terms-item-down-payment">от 0%</p>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-6 col-md-3 lending-terms-item-left">
								<p>средняя ставка</p>
							</div>
							<div class="col-6 col-md-5 lending-terms-item-right">
								<p id="lending-terms-item-average-rate">от 9,7% (средняя 10,5%)</p>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>


	<div class="col-5 arrow-lending-terms">
		<div class="row">
			<div class="col-4 col-md-3"><p><img src="/images/content/arrow_lending_terms.png" /></p></div>
			<div class="col-8"><p class="revealator-zoomout revealator-delay1 revealator-once revealator-below">Теперь вы можете<br>рассчитать кредит</p></div>
		</div>
	</div>

</section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/include/credit/credit_calcul_two.php"); ?>