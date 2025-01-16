<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\Address;
use App\Models\User;
use App\Notifications\UserNotification;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    public $title;
    public $userService;
    public $current_page = 'users';

    public function __construct(UserService $userService)
    {
        date_default_timezone_set("Asia/Tashkent");
        $this->userService = $userService;
        $this->title = $this->getTableTitle('Users');
    }

    public function index()
    {
        $users_ = User::all();
        $users = [];
        foreach($users_ as $user){
            $images = [];
            if($user->images) {
                $images_ = json_decode($user->images);
                $is_image = 0;
                foreach ($images_ as $image) {
                    if(!$image){
                        $image = 'no';
                    }
                    $avatar_main = storage_path('app/public/users/' . $image);
                    if (file_exists($avatar_main)) {
                        $is_image = 1;
                        $images[] = asset("storage/users/$image");
                    }
                }
                if($is_image == 0){
                    $images = [asset('icon/no_photo.jpg')];
                }
            }else{
                $images = [asset('icon/no_photo.jpg')];
            }

            if($user->captured_image){
                $capturedImage = $user->captured_image;
            }else{
                $capturedImage = 'no';
            }

            $captured_image_main = storage_path('app/public/users/' . $capturedImage);
            if(file_exists($captured_image_main)){
                $captured_image = asset("storage/users/$capturedImage");
            }else{
                $captured_image = asset('icon/no_photo.jpg');
            }

            if($user->professions){
                $professions = json_decode($user->professions);
            }else{
                $professions = [];
            }
            if($user->status == Constants::ACTIVE){
                $status_text = translate_title('Active');
            }else{
                $status_text = translate_title('Not active');
            }

            if($user->address){
                $address = $this->userService->getAddress($user->address);
            }else{
                $address = '';
            }

            $gender = '';
            if($user->gender == Constants::MALE){
                $gender = translate_title('Men');
            }elseif($user->gender == Constants::FEMALE){
                $gender = translate_title('Women');
            }

            if($user->born_at){
                $old = $this->userService->getAge($user);
            }else{
                $old = 0;
            }

            $users[] = [
                'id'=>$user->id,
                'name'=>$user->name,
                'user_info'=>$user->user_info,
                'born_at'=>$user->born_at,
                'age'=>$old,
                'instagram_url'=>$user->instagram_url,
                'images'=>$images,
                'professions'=>$professions,
                'captured_image'=>$captured_image,
                'gender'=>$gender,
                'status_'=>$user->status,
                'status'=>$status_text,
                'email'=>$user->email,
                'is_admin'=>$user->is_admin,
                'address'=>$address,
                'created_at'=>$user->created_at,
                'updated_at'=>$user->updated_at,
            ];
        }

        return view('users.index', [
            'users'=>$users,
            'title'=>$this->title,
            'current_page'=>$this->current_page,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $address = new Address();
        if($request->district && $request->region){
            $address = new Address();
            if($request->district){
                $address->city_id = $request->district;
            }elseif($request->region){
                $address->city_id = $request->region;
            }
            $address->name = $request->address;
            $address->save();
        }

//        if($request->new_password && $request->new_password != $request->password_confirmation){
//            return redirect()->back()->with('error', translate_title('Your new password confirmation is incorrect'));
//        }
//        if($request->new_password && !$request->email){
//            return redirect()->back()->with('error', translate_title('Your don\'t have email'));
//        }

        $address->name = $request->address;
        $address->save();
        $users = new User();
        $users->name = $request->name;
        $users->user_info = $request->user_info;
        $users->born_at = $request->born_at;
        $users->instagram_url = $request->instagram_url;
        $users->professions = json_encode($request->professions);
        $users->address_id = $address->id;
        if($request->female){
            $users->gender = Constants::FEMALE;
        }elseif($request->male){
            $users->gender = Constants::MALE;
        }
        if($request->status){
            $users->status = Constants::ACTIVE;
        }else{
            $users->status = Constants::NOT_ACTIVE;
        }
        $users->images = $this->imageSave($users, $request->images, 'store');
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->save();

        return redirect()->route('users.index')->with('success', translate_title('Successfully created'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $images = [];
        if($user->professions){
            $professions = json_decode($user->professions);
        }else{
            $professions = [];
        }
        if($user->images){
            $images = json_decode($user->images);
        }
        return view('users.edit', [
            'user'=>$user,
            'images'=>$images,
            'professions'=>$professions,
            'title'=>$this->title,
            'current_page'=>$this->current_page,
        ]);
    }

    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);
        if ($request->password && $request->new_password && $request->password_confirmation) {
            if($request->email){
                if (Hash::check($request->password, $users->password) && $request->new_password == $request->password_confirmation) {
                    $users->password = Hash::make($request->new_password);
                }else{
                    if(!Hash::check($request->password, $users->password)){
                        return redirect()->back()->with('error', translate_title('Your password is incorrect'));
                    }elseif($request->new_password != $request->password_confirmation){
                        return redirect()->back()->with('error', translate_title('Your new password confirmation is incorrect'));
                    }
                }
            }else{
                return redirect()->back()->with('error', translate_title('Your don\'t have email'));
            }
        }elseif($request->password && $request->new_password && !$request->password_confirmation){
            return redirect()->back()->with('error', translate_title('Your new password confirmation is incorrect'));
        }
        if($users->address){
            $address = $users->address;
        }else{
            $address = new Address();
        }
        if($request->district){
            $address->city_id = $request->district;
        }elseif($request->region){
            $address->city_id = $request->region;
        }
        $address->name = $request->address;
        $address->user_id = $users->id;
        $address->save();

        $users->name = $request->name;
        $users->user_info = $request->user_info;
        $users->born_at = $request->born_at;
        $users->instagram_url = $request->instagram_url;
        $users->professions = json_encode($request->professions);
        $users->address_id = $address->id;
        if($request->status){
            $users->status = Constants::ACTIVE;
        }else{
            $users->status = Constants::NOT_ACTIVE;
        }
        if($request->female){
            $users->gender = Constants::FEMALE;
        }elseif($request->male){
            $users->gender = Constants::MALE;
        }
        $users->images = $this->imageSave($users, $request->images, 'update');
        $users->email = $request->email;
        $users->address_id = $address->id;
        $users->password = Hash::make($request->password);
        $users->save();
        return redirect()->route('users.index')->with('success', translate_title('Successfully updated'));
    }

    public function userCreate(){
        return view('users_auth', [
            'title'=>$this->title,
            'current_page'=>$this->current_page]
        );
    }

    public function userStore(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->user_info = $request->info;
        $user->born_at = $request->born_at;

//        if($request->district && $request->region){
//            $address = new Address();
//            if($request->district){
//                $address->city_id = $request->district;
//            }elseif($request->region){
//                $address->city_id = $request->region;
//            }
//            $address->name = $request->address;
//            $address->save();
//        }
        if($request->region){
            $address = new Address();
            $address->city_id = $request->region;
            $address->name = $request->address;
            $address->save();
            $user->address_id = $address->id;
        }

        if($request->female){
            $user->gender = Constants::FEMALE;
        }elseif($request->male){
            $user->gender = Constants::MALE;
        }

        $user->instagram_url = 'https://'.$request->instagram_url;
        $user->professions = json_encode($request->profession_select);
        $your_photo_1 = $request->file('your_photo_1');
        $your_photo_2 = $request->file('your_photo_2');
        $your_photo_3 = $request->file('your_photo_3');
        $user->images = $this->imageSave($user, [$your_photo_1, $your_photo_2, $your_photo_3], 'store');
        if($request->captured_image){
            $image = $request->file('captured_image');
            $random = $this->setRandom();
            $user_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
            $image->storeAs('public/users/', $user_image_name);
            $user->captured_image =  $user_image_name;
        }
        $user->save();

        $users = User::where('is_admin', Constants::USER_ADMIN)->get();
        if($user->captured_image){
            $capturedImage = $user->captured_image;
        }else{
            $capturedImage = 'no';
        }
        $captured_image_main = storage_path('app/public/users/' . $capturedImage);
        if(file_exists($captured_image_main)){
            $captured_image = asset("storage/users/$capturedImage");
        }else{
            $captured_image = asset('icon/no_photo.jpg');
        }
        $data = [
          'id'=>$user->id,
          'name'=>$user->name,
          'capturedImage'=>$captured_image,
        ];
        Notification::send($users, new UserNotification($data));
        $response = [
            'status'=>true,
            'message'=>'Success'
        ];
        return response()->json($response);
    }

    public function imageSave($user, $images, $text){
        $lang = App::getLocale();
        if($text == 'update'){
            if($user->images && !is_array($user->images)){
                $user_images = json_decode($user->images);
            }else{
                $user_images = [];
            }
        }else{
            $user_images = [];
        }
        $all_product_images = [];
//        if(isset($images)){
//            $UserImage = [];
//            foreach($images as $image){
//                $random = $this->setRandom();
//                $image_image_name = $random.''.date('Y-m-dh-i-s').'.'.$image->extension();
//                $image->storeAs('public/users/', $image_image_name);
//                $UserImage[] = $image_image_name;
//            }
//            $all_user_images = array_values(array_merge($user_images, $UserImage));
//        }

        $mb = 1024 * 1024;
        $shrink_percent = 100;

        if (isset($images)) {
            $ProductImage = [];
            foreach ($images as $image) {
                $image_size = $image->getSize();

                // Shrink parameter logic
                if ($image_size > 14 * $mb && $image_size <= 15 * $mb) {
                    $shrink_percent = 3.33;
                } elseif ($image_size > 13 * $mb && $image_size <= 14 * $mb) {
                    $shrink_percent = 3.57;
                } elseif ($image_size > 12 * $mb && $image_size <= 13 * $mb) {
                    $shrink_percent = 3.85;
                } elseif ($image_size > 11 * $mb && $image_size <= 12 * $mb) {
                    $shrink_percent = 4.16;
                } elseif ($image_size > 10 * $mb && $image_size <= 11 * $mb) {
                    $shrink_percent = 4.55;
                } elseif ($image_size > 9 * $mb && $image_size <= 10 * $mb) {
                    $shrink_percent = 5;
                } elseif ($image_size > 8 * $mb && $image_size <= 9 * $mb) {
                    $shrink_percent = 5.56;
                } elseif ($image_size > 7 * $mb && $image_size <= 8 * $mb) {
                    $shrink_percent = 6.25;
                } elseif ($image_size > 6 * $mb && $image_size <= 7 * $mb) {
                    $shrink_percent = 7.14;
                } elseif ($image_size > 5 * $mb && $image_size <= 6 * $mb) {
                    $shrink_percent = 8.33;
                } elseif ($image_size > 4 * $mb && $image_size <= 5 * $mb) {
                    $shrink_percent = 10;
                } elseif ($image_size > 3 * $mb && $image_size <= 4 * $mb) {
                    $shrink_percent = 12.5;
                } elseif ($image_size > 2 * $mb && $image_size <= 3 * $mb) {
                    $shrink_percent = 16.67;
                } elseif ($image_size > $mb && $image_size <= 2 * $mb) {
                    $shrink_percent = 25;
                } elseif ($image_size > $mb / 2 && $image_size <= $mb) {
                    $shrink_percent = 50;
                } elseif ($image_size > 15 * $mb) {
                    return redirect()->back()->with('error', translate_title('Your image is bigger than 15 MB'));
                } elseif ($image_size <= $mb / 2) {
                    $shrink_percent = 100;
                }

                // Yangi fayl nomini yaratish
                $random = $this->setRandom();
                $product_image_name = $random . date('Y-m-d_h-i-s') . '.' . $image->extension();

                $img = Image::make($image->getRealPath());

                // Shrink logic
                if ($shrink_percent < 100) {
                    $img->encode($image->extension(), $shrink_percent);
                }

                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $path = storage_path('app/public/users');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }

                $img->save($path . '/' . $product_image_name);
                $ProductImage[] = $product_image_name;
            }

            $all_product_images = array_values(array_merge($user_images, $ProductImage));
        }

        $UserImage = json_encode($all_user_images ?? $user_images);
        return $UserImage;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = User::find($id);
        if($model){
            $images = json_decode($model->images);
            foreach($images as $image){
                if ($image) {
                    $avatar = storage_path('app/public/users/'.$image);
                } else {
                    $avatar = 'no';
                }
                if (file_exists($avatar)) {
                    unlink($avatar);
                }
            }

            $catured_image = $model->catured_image;
            if ($catured_image) {
                $catured_image_ = storage_path('app/public/users/'.$catured_image);
            } else {
                $catured_image_ = 'no';
            }
            if (file_exists($catured_image_)) {
                unlink($catured_image_);
            }

            $model->delete();
        }
        return redirect()->route('users.index')->with('status', translate_title('Successfully deleted'));
    }

    public function deleteProductImage(Request $request){
        $user = User::find($request->id);
        if($user->images && !is_array($user->images)){
            $user_images_base = json_decode($user->images);
        }else{
            $user_images_base = [];
        }
        if(is_array($user_images_base)){
            if(isset($request->image_file)){
                $selected_product_key = array_search($request->image_file, $user_images_base);
                if(!$request->image_file){
                    $request->image_file = 'no';
                }
                $user_image_ = storage_path('app/public/users/'.$request->image_file);
                if(file_exists($user_image_)){
                    unlink($user_image_);
                }
                unset($user_images_base[$selected_product_key]);
            }
            $user->images = json_encode(array_values($user_images_base));
            $user->save();
        }
        return response()->json([
            'status'=>true,
            'message'=>'Success'
        ], 200);
    }

    public function changeStatus(Request $request){
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return redirect()->back()->with('success', 'User status changed successfully!');
    }
}
