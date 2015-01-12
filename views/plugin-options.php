<div class="wrap">
  
  <h2><?php _e('Talande Webb Plus', 'talandewebb'); ?></h2>
  
  <p>För att Talande Webb Plus ska fungera optimalt för dina besökare lägger du in ett script som sätter en cookie (kaka) på webbplatsen. På sidan där du beskriver hur Talande Webb fungerar lägger du till en förklarande text om Talande Webb Plus och en länk som tänder själva verktygsfältet för Talande Webb Plus.</p>

  <h3 class="title">Kom igång</h3>

  <p>Placera någon av följande exempel under en sida, inlägg eller widget.</p>

  <table class="form-table">
    <tbody>
      <tr>
        <th class="row">
          <label>Shortcode</label>
        </th>
        <td>
          <input type="text" value="[talandewebb]" class="regular-text" onclick="this.focus();this.select()">
          <p class="description">T.ex <code>[talandewebb class="tw-btn"]</code> - <code>class</code> är friviligt.</p>
        </td>
      </tr>
      <tr>
        <th>
          <label>Länk</label>
        </th>
        <td>
          <input type="text" value='<a href="#" onclick="toggleBar();" title="Aktivera Talande Webb" >Aktivera Talande Webb</a>' class="regular-text" onclick="this.focus();this.select()">
        </td>
      </tr>
      <tr>
        <th>
          <label>Button</label>
        </th>
        <td>
          <input type="text" value='<button onclick="toggleBar();" >Aktivera Talande Webb</button>' class="regular-text" onclick="this.focus();this.select()">
        </td>
      </tr>
    </tbody>
  </table>

  <h3 class="title">För utvecklare</h3>

  <p><strong>Med JavaScript:</strong></p>

  <code style="display: inline-block;">
<pre>var btn = document.getElementById('tw-btn');
btn.addEventListener('click', toggleBar());</pre>
  </code>

  <p><strong>Med jQuery:</strong></p>

  <code style="display: inline-block;">
<pre>var btn = $('#tw-btn');
btn.on('click', toggleBar());</pre>
  </code>
  
</div>
<!-- /.wrap -->
