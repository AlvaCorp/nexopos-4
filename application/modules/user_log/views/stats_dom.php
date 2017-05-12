<div class="row" ng-controller="userLogStatsController">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header with-border">
                <div class="box-title">
                    <?php echo __( 'Heures de travail des utilisateurs par mois Année courante', 'perm_manager' );?>
                </div>
                <div class="box-tools">
                
                </div>
            </div>
            <div class="box-body">
                <canvas 
                    id="bar" 
                    class="chart chart-bar"
                    chart-data="hoursPerUsers" 
                    chart-labels="monthsLabels" 
                    chart-series="usersName"
                    chart-options="barOptions"
                    width = "90%"
                >
                </canvas>
            </div>
        </div>
    </div>
</div>