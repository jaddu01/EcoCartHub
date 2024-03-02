<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $country_code
 * @property string $phone_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Database\Factories\AdminFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin withoutTrashed()
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cart
 *
 * @property int $id
 * @property int $user_id
 * @property string $total_price
 * @property string $discount
 * @property string $grand_total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CartItem> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CartFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereGrandTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cart whereUserId($value)
 */
	class Cart extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CartItem
 *
 * @property int $id
 * @property int $cart_id
 * @property int $product_id
 * @property int $quantity
 * @property string|null $color
 * @property string $product_price
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cart $cart
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\CartItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereCartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereUpdatedAt($value)
 */
	class CartItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $category_name
 * @property string $description
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property string $order_number
 * @property string $total_price
 * @property string $discount
 * @property string $grand_total
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderItem> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereGrandTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order withoutTrashed()
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderItem
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property string $product_price
 * @property string|null $color
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem withoutTrashed()
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $product_name
 * @property string $brand
 * @property string $description
 * @property int $quantity
 * @property string $product_price
 * @property string|null $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CartItem> $cart_items
 * @property-read int|null $cart_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\ProductImage|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductImage> $images
 * @property-read int|null $images_count
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Product withoutTrashed()
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductImage
 *
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property string|null $image_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\ProductImageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereImageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImage whereUpdatedAt($value)
 */
	class ProductImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Task
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $due_date
 * @property int $priority_level
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task wherePriorityLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Task withoutTrashed()
 */
	class Task extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string $country_code
 * @property string $phone_number
 * @property string|null $otp
 * @property string|null $otp_expires_at
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\UserAddress|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserAddress> $addresses
 * @property-read int|null $addresses_count
 * @property-read \App\Models\Cart|null $cart
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client> $clients
 * @property-read int|null $clients_count
 * @property-read mixed $full_name
 * @property-read mixed $full_phone_number
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOtpExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserAddress
 *
 * @property int $id
 * @property int $user_id
 * @property string $address_line_1
 * @property string|null $address_line_2
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $postal_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserAddressFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUserId($value)
 */
	class UserAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserTask
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTask query()
 */
	class UserTask extends \Eloquent {}
}

