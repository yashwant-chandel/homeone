<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin-dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('admin-dashboard', route('admin-dashboard'));
}); 
Breadcrumbs::for('Employe-list', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Employees', route('Employe-list'));
});
Breadcrumbs::for('Employe-add', function (BreadcrumbTrail $trail) {
    $trail->parent('Employe-list');
    $trail->push('Register', route('Employe-register'));
});

//products
Breadcrumbs::for('product-list', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('Products', route('products'));
});

Breadcrumbs::for('product-add', function (BreadcrumbTrail $trail) {
    $trail->parent('product-list');
    $trail->push('Add', route('products-add'));
});

Breadcrumbs::for('Category', function (BreadcrumbTrail $trail) {
    $trail->parent('product-list');
    $trail->push('Category', route('category'));
});

?>