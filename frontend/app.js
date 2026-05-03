/**
 * LabSeat — fetch reports and hook up buttons/forms.
 *
 * TEAMMATE OWNERSHIP — Person 2:
 *   - frontend/forms, buttons, style.css, and app.js user actions
 *
 * Adjust API_BASE if your PHP server runs on a different port.
 */

(function () {
  'use strict';

  // Run PHP from the project root: `php -S localhost:8000` then open /frontend/.
  var API_BASE = '/backend';

  var listEl = document.getElementById('availability-list');
  var outEl = document.getElementById('output');

  function setOutput(obj) {
    outEl.textContent = typeof obj === 'string' ? obj : JSON.stringify(obj, null, 2);
  }

  function fetchReports() {
    setOutput('Loading…');
    fetch(API_BASE + '/get_reports.php')
      .then(function (res) {
        return res.json();
      })
      .then(function (data) {
        setOutput(data);
        if (data && data.ok && Array.isArray(data.reports)) {
          listEl.innerHTML = data.reports.length
            ? data.reports.map(function (row, i) {
                return '<li><pre>' + JSON.stringify(row) + '</pre></li>';
              }).join('')
            : '<li>(No rows yet — replace starter query on the backend.)</li>';
        }
      })
      .catch(function (err) {
        listEl.innerHTML = '<li>Could not load — is PHP running? See README.</li>';
        setOutput('Error: ' + err.message);
      });
  }

  document.getElementById('btn-refresh').addEventListener('click', fetchReports);

  document.getElementById('btn-add').addEventListener('click', function () {
    var notes = document.querySelector('#report-form input[name="notes"]').value;
    // TODO (Person 2): POST real fields matching add_report.php.
    fetch(API_BASE + '/add_report.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ notes: notes }),
    })
      .then(function (res) {
        return res.json();
      })
      .then(setOutput)
      .catch(function (err) {
        setOutput('Error: ' + err.message);
      });
  });

  // Initial load
  fetchReports();
})();
