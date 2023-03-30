<table class="table w100 entrytable">
	<tr>
		<th><span class="must">必須</span>氏名</th>
		<td><input type="text" name="氏名" placeholder="氏名" required /></td>
	</tr>
	<tr>
		<th><span class="must">必須</span>フリガナ</th>
		<td><input type="text" name="フリガナ" placeholder="フリガナ" required /></td>
	</tr>
	<tr>
		<th>電話番号</th>
		<td><input type="tel" name="電話番号" placeholder="電話番号" /></td>
	</tr>
	<tr>
		<th>生年月日</th>
		<td>
			<select name="年" class="multi">
				<option value="1950">1950</option>
				<option value="1951">1951</option>
				<option value="1952">1952</option>
				<option value="1953">1953</option>
				<option value="1954">1954</option>
				<option value="1955">1955</option>
				<option value="1956">1956</option>
				<option value="1957">1957</option>
				<option value="1958">1958</option>
				<option value="1959">1959</option>
				<option value="1960">1960</option>
				<option value="1961">1961</option>
				<option value="1962">1962</option>
				<option value="1963">1963</option>
				<option value="1964">1964</option>
				<option value="1965">1965</option>
				<option value="1966">1966</option>
				<option value="1967">1967</option>
				<option value="1968">1968</option>
				<option value="1969">1969</option>
				<option value="1970" selected>1970</option>
				<option value="1971">1971</option>
				<option value="1972">1972</option>
				<option value="1973">1973</option>
				<option value="1974">1974</option>
				<option value="1975">1975</option>
				<option value="1976">1976</option>
				<option value="1977">1977</option>
				<option value="1978">1978</option>
				<option value="1979">1979</option>
				<option value="1980">1980</option>
				<option value="1981">1981</option>
				<option value="1982">1982</option>
				<option value="1983">1983</option>
				<option value="1984">1984</option>
				<option value="1985">1985</option>
				<option value="1986">1986</option>
				<option value="1987">1987</option>
				<option value="1988">1988</option>
				<option value="1989">1989</option>
				<option value="1990">1990</option>
				<option value="1991">1991</option>
				<option value="1992">1992</option>
				<option value="1993">1993</option>
				<option value="1994">1994</option>
				<option value="1995">1995</option>
				<option value="1996">1996</option>
				<option value="1997">1997</option>
				<option value="1998">1998</option>
				<option value="1999">1999</option>
				<option value="2000">2000</option>
				<option value="2001">2001</option>
				<option value="2002">2002</option>
				<option value="2003">2003</option>
				<option value="2004">2004</option>
				<option value="2005">2005</option>
				<option value="2006">2006</option>
				<option value="2007">2007</option>
				<option value="2008">2008</option>
				<option value="2009">2009</option>
				<option value="2010">2010</option>
			</select>
			&nbsp;&nbsp;
			<select name="月" class="multi">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
			</select>
			&nbsp;&nbsp;
			<select name="日" class="multi">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
			</select>

		</td>
	</tr>
	<tr>
		<th><span class="must">必須</span>メールアドレス</th>
		<td><input type="email" name="メールアドレス" id="email_1"　placeholder="メールアドレス" required /></td>
	</tr>
	<tr>
		<th><span class="must">必須</span>確認用メールアドレス</th>
		<td><input type="email" name="確認用メールアドレス" id="emailConfirm_1" placeholder="確認用メールアドレス" required oninput="CheckEmail_1(this)"/></td>
	</tr>
	<tr>
		<th>お問い合わせ内容</th>
		<td><textarea name="お問い合わせ内容" ></textarea></td>
	</tr>
	<tr>
		<th><span class="must">必須</span>個人情報の取り扱いについて</th>
		<td>
			<label class="form_label form_checkbox"><input type="checkbox" name="privacypolicy[]" value="同意する" required>同意する</label>
			<p>個人情報の取り扱いについて、弊社Webサイトの<a href="/privacy/" target="_blank" style="text-decoration:underline;">個人情報保護方針</a>を確認の上、ご同意いただき送信をお願いいたします。</p>
		</td>
	</tr>
</table>
<p class="submit">
	<input type="submit"id="submit" value="ご応募　確認画面へ" />
</p>
