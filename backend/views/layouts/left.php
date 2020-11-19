<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                   
                    
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['dashboard/index']],
                   

                    // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'MENU',
                        'icon' => 'fa menu',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Orders', 'icon' => 'fa orders', 'url' => ['orders/index'],],
                            ['label' => 'Payments', 'icon' => 'fa payment', 'url' => ['payment/index'],],
                            ['label' => 'Products', 'icon' => 'fa products', 'url' => ['product/index'],],
                            
                            ],
                        ],
                        [
                            'label' => 'Manage users',
                            'icon' => 'fa fa-wrench',
                            'url' => '#',
                            'items' => [
                                ['label' => 'users', 'icon' => 'fa users', 'url' => ['user/index'],],
                                ['label' => 'roles', 'icon' => 'file-code-o', 'url' => ['roles/index'],],
                               
                                
                                ],
                            ],
                        
                    ],
                   
                    
                ]
        
    

        ) ?>

    </section>

</aside>
