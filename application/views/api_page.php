<br /><hr />
<section>

  <h1>Receive a list of all People</h1>
  
  <p>
  The simplest way to get people is to simply call people with no parameters.
  </p>
  <p>
  This will bring back the first 100 visible people to a user, with respect to visibility rules.
  </p>
  <br />
  <h3>Request format</h3>

  <label class="label label-info">GET /people</label>
  <br />
  <br />
  <h3>Request Parameters</h3>
 
  <table class="table">
    <thead>
      <tr>
        <th>PARAM</th>
        <th>TYPE</th>
        <th>DESCRIPTION</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>first_name</td>
        <td><label class="label label-warning">string</label></td>
        <td>The people with first name like first_name</td>
      </tr>
      <tr>
        <td>last_name</td>
        <td><label class="label label-warning">string</label></td>
        <td>The people with last name like last_name</td>
      </tr>
      <tr>
        <td>email_address</td>
        <td><label class="label label-warning">string</label></td>
        <td>The people with email address like email_address</td>
      </tr>
    </tbody>
  </table>
  <br />
  <hr />
  <div><strong>Examples</strong></div>
  <br />
  <div class="well well-sm">curl "<?php print base_url(); ?>api/v1/people?api_key=<?php print $api_key; ?>"</div>
  
  <div><strong>HTTP Code</strong></div>
  <br />
  <div class="well well-sm">200</div>
  
  <div><strong>Body</strong></div>
  <br />
  <div class="well well-sm">
    <pre>
      [
          {
              "first_name": "ivan clint acedillo",
              "last_name": "pabelona",
              "email_address": "ipabelona@gmail.com",
              "person_id": "1",
              "account_id": "1",
              "password": "38c02088daa5f90e8de64cf9bd056fa849533cca",
              "account_status": "active",
              "date_created": "2015-02-26 07:38:56",
              "last_updated": "2015-02-26 07:38:56",
              "api_key": "9fd2630e26c6af497622eb98d041ed46f129af0e",
              "gender": ""
          },
          {
              "first_name": "kent john",
              "last_name": "pabelona",
              "email_address": "kentjohnpabelona@gmail.com",
              "person_id": "2",
              "account_id": "2",
              "password": "6f7d1330e4ad54be9c3575f10c0b5a4a409038f4",
              "account_status": "active",
              "date_created": "2015-02-26 07:49:05",
              "last_updated": "2015-02-26 07:49:05",
              "api_key": "21a45d175b469a80eddca7ac440ca11626b79513",
              "gender": "M"
          }
      ]
    </pre>
  </div>
  <hr />
  <br /><br />
  <h1>Update a person</h1>
  <h3>Request format</h3>

  <label class="label label-info">PUT /person/:id</label>

  <br />
  <hr />
  <div><strong>Examples</strong></div>
  <br />
  <div class="well well-sm">
    curl -X PUT -d "first_name=ivanpabz" "<?php print base_url(); ?>api/v1/person/<?php print $this->session->userdata('person_id'); ?>?api_key=<?php print $api_key; ?>"
  </div>
  
  <div><strong>HTTP Code</strong></div>
  <br />
  <div class="well well-sm">200</div>
  
  <div><strong>Body</strong></div>
  <br />
  <div class="well well-sm">
    <pre>
      {
          "first_name": "ivanpabz",
          "last_name": "pabelona",
          "email_address": "ipabelona@gmail.com",
          "person_id": "1",
          "account_id": "1",
          "password": "38c02088daa5f90e8de64cf9bd056fa849533cca",
          "account_status": "active",
          "date_created": "2015-02-26 07:38:56",
          "last_updated": "2015-02-26 07:38:56",
          "api_key": "9fd2630e26c6af497622eb98d041ed46f129af0e",
          "gender": ""
      }
    </pre>
  </div>
</section>

<br /><br /><br />