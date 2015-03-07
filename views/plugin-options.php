<div class="wrap">

  <h2><?php echo talandewebb()->name; ?></h2>

  <p><?php echo talandewebb()->description; ?></p>

  <form id="talandewebb_settings" action="" method="post">

    <?php
      // Save plugin options on post.
      if ( talandewebb_is_method( 'post' ) ) {
        _talandewebb_save_plugin_options();
      }
    ?>

    <table class="form-table">
      <tbody>
        <tr>
          <th class="row">
            <label for="talandewebb_plugin_option_activation">Aktivera</label>
          </th>
          <td>
            <input type="hidden" name="talandewebb_plugin_option_activation" value="off" />
            <input type="checkbox" name="talandewebb_plugin_option_activation" <?php echo talandewebb_get_plugin_option( 'activation', "on" ) === "on" ? 'checked' : ''; ?> />
          </td>
        </tr>
      </tbody>
    </table>

    <?php submit_button(); ?>

  </form>

  <h3 class="title">Kom igång</h3>

  <p>Placera någon av följande exempel under en sida, inlägg eller widget.</p>

  <table class="form-table">
    <tbody>
      <tr>
        <th class="row">
          <label>Shortcode</label>
        </th>
        <td>
          <input type="text" value="[talandewebb]Aktivera Talande Webb[/talandewebb]" class="regular-text" onclick="this.focus();this.select()">
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

  <p><strong>JavaScript:</strong></p>

  <code style="display: inline-block;">
<pre>var btn = document.getElementById('tw-btn');
btn.addEventListener('click', toggleBar());</pre>
  </code>

  <p><strong>jQuery:</strong></p>

  <code style="display: inline-block;">
<pre>var btn = $('#tw-btn');
btn.on('click', toggleBar());</pre>
  </code>

</div>
<!-- /.wrap -->
