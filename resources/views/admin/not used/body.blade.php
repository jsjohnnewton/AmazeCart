          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
              <div class="row align-items-center">
                  <div class="col-md-6">
                      <div class="title">
                          <h2>eCommerce Dashboard</h2>
                      </div>
                  </div>
                  <!-- end col -->

              </div>
              <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->
          <div class="row">
              <div class="col-xl-3 col-lg-4 col-sm-6">
                  <div class="icon-card mb-30">
                      <div class="icon purple">
                          <i class="lni lni-cart-full"></i>
                      </div>
                      <div class="content">
                          <h6 class="mb-10">New Orders</h6>
                          <h3 class="text-bold mb-10">{{$order_process}}</h3>
                          <p class="text-sm text-success">
                              <i class="lni lni-arrow-up"></i> +2.00%
                              <span class="text-gray">(30 days)</span>
                          </p>
                      </div>
                  </div>
                  <!-- End Icon Cart -->
              </div>
              <!-- End Col -->
              <div class="col-xl-3 col-lg-4 col-sm-6">
                  <div class="icon-card mb-30">
                      <div class="icon success">
                          <i class="lni lni-rupee"></i>
                      </div>
                      <div class="content">
                          <h6 class="mb-10">Total Income </h6>

                          <h3 class="text-bold mb-10">{{$month_total_revenue}}</h3>
                          <p class="text-sm text-success">
                              <i class="lni lni-arrow-up"></i> +5.45%
                              <span class="text-gray">Increased</span>
                          </p>
                      </div>
                  </div>
                  <!-- End Icon Cart -->
              </div>
              <!-- End Col -->

              <!-- End Col -->
              <div class="col-xl-3 col-lg-4 col-sm-6">
                  <div class="icon-card mb-30">
                      <div class="icon orange">
                          <i class="lni lni-user"></i>
                      </div>
                      <div class="content">
                          <h6 class="mb-10">Total User</h6>
                          <h3 class="text-bold mb-10">{{$total_user}}</h3>
                          <p class="text-sm text-danger">
                              <i class="lni lni-arrow-down"></i> -25.00%
                              <span class="text-gray"> Earning</span>
                          </p>
                      </div>
                  </div>
                  <!-- End Icon Cart -->
              </div>
              <!-- End Col -->
              <div class="col-xl-3 col-lg-4 col-sm-6">
                  <div class="icon-card mb-30">
                      <div class="icon orange">
                          <i class="lni lni-user"></i>
                      </div>
                      <div class="content">
                          <h6 class="mb-10">New User</h6>
                          <h3 class="text-bold mb-10">{{$new_user}}</h3>
                          <p class="text-sm text-danger">
                              <i class="lni lni-arrow-down"></i> -25.00%
                              <span class="text-gray"> Earning</span>
                          </p>
                      </div>
                  </div>
                  <!-- End Icon Cart -->
              </div>
              <!-- End Col -->
          </div>
          <!-- End Row -->




          <div class="row">
              <!-- End Col -->
              <div class="col-lg-12">
                  <div class="card-style mb-30">
                      <div class="title d-flex flex-wrap align-items-center justify-content-between">
                          <div class="left">
                              <h6 class="text-medium mb-30">Users</h6>
                          </div>

                      </div>
                      <!-- End Title -->
                      <div class="table-responsive">
                          <table class="table top-selling-table">
                              <thead>
                                  <tr>
                                      <th>
                                          <h6 class="text-sm text-medium">User Name</h6>
                                      </th>
                                      <th class="min-width">
                                          <h6 class="text-sm text-medium">
                                              Email <i class="lni lni-arrows-vertical"></i>
                                          </h6>
                                      </th>
                                      <th class="min-width">
                                          <h6 class="text-sm text-medium">
                                              User Type <i class="lni lni-arrows-vertical"></i>
                                          </h6>
                                      </th>
                                      <th class="min-width">
                                          <h6 class="text-sm text-medium">
                                              Phone Number <i class="lni lni-arrows-vertical"></i>
                                          </h6>
                                      </th>
                                      <th class="min-width">
                                          <h6 class="text-sm text-medium">
                                              Date of Birth <i class="lni lni-arrows-vertical"></i>
                                          </h6>
                                      </th>
                                      <th class="min-width">
                                          <h6 class="text-sm text-medium">
                                              Email Verification <i class="lni lni-arrows-vertical"></i>
                                          </h6>
                                      </th>

                                      <th>
                                          <h6 class="text-sm text-medium text-end">
                                              Date of joining <i class="lni lni-arrows-vertical"></i>
                                          </h6>
                                      </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($users as $user)

                                  <tr>
                                      <td>
                                          <p class="text-sm">{{$user->name}}</p>
                                      </td>
                                      <td>
                                          <p class="text-sm">{{$user->email}}</p>
                                      </td>
                                      <td>
                                          <p class="text-sm"> @if($user->usertype==1)
                                              Admin
                                              @else
                                              User
                                              @endif</p>
                                      </td>
                                      <td>
                                          <p class="text-sm">{{$user->phone}} </p>
                                      </td>
                                      <td>
                                          <p class="text-sm">{{$user->dob}} </p>
                                      </td>
                                      <td>
                                          @if($user->email_verified_at == null)
                                          <span class="status-btn close-btn">Not Verified</span>
                                          @else
                                          <span class="status-btn success-btn">Verified</span>
                                          @endif

                                      </td>
                                      <td>
                                          <p class="text-sm">{{$user->created_at}}</p>
                                      </td>


                                  </tr>

                                  @endforeach
                              </tbody>
                          </table>
                          <!-- End Table -->
                      </div>
                  </div>
              </div>
              <!-- End Col -->
          </div>

          <div class="row">

              <div class="col-lg-12">
                  <div class="card-style">
                      <h2 class="text-xl font-bold mb-3">Recent Order</h2>
                      <canvas id="recentOrderChart"></canvas>

                  </div>
                  <div class="card-style">
                      <h2 class="text-xl font-bold mb-3">Sales Data</h2>
                      <canvas id="salesDataChart"></canvas>

                  </div>
              </div>
          </div>


          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

          <script>
              // Function to fetch data from Laravel controller
              function fetchData() {
                  console.log('step 1');
                  // AJAX request to fetch data from Laravel controller
                  fetch('/chart-data')
                      .then(response => response.json())
                      .then(data => {
                          // Call functions to update charts with received data
                          updateRecentOrderChart(data.recentOrders);
                          updateSalesDataChart(data.salesData);
                      })
                      .catch(error => console.error('Error fetching data:', error));


              }

              // Function to update Recent Order chart
              function updateRecentOrderChart(recentOrderData) {
                  console.log('step 2');
                  // Format data for Chart.js
                  var labels = recentOrderData.map(item => item.hour);
                  var dataset = recentOrderData.map(item => item.order_count);

                  // Initialize chart
                  var ctx = document.getElementById('recentOrderChart').getContext('2d');
                  new Chart(ctx, {
                      type: 'line',
                      data: {
                          labels: labels,
                          datasets: [{
                              label: 'Recent Orders',
                              data: dataset,
                              fill: false,
                              borderColor: 'rgba(54, 162, 235, 1)',
                              borderWidth: 1
                          }]
                      }
                  });
              }

              // Function to update Sales Data chart
              function updateSalesDataChart(salesData) {
                  console.log('step 3');

                  // Format data for Chart.js
                  var labels = salesData.map(item => item.month);
                  var dataset = salesData.map(item => item.total_sales);

                  // Initialize chart
                  var ctx = document.getElementById('salesDataChart').getContext('2d');
                  new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels: labels,
                          datasets: [{
                              label: 'Sales Data',
                              data: dataset,
                              backgroundColor: 'rgba(255, 99, 132, 0.2)',
                              borderColor: 'rgba(255, 99, 132, 1)',
                              borderWidth: 1
                          }]
                      }
                  });
              }

              // Call fetchData function when page loads
              window.onload = fetchData;
          </script>