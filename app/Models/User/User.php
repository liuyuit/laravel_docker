<?php

namespace App\Models\User;

use App\Models\Material\Material;
use App\Models\Material\SubscribeMaterial;
use App\Models\Model;
use App\Models\Pay\Order;
use App\Services\User\Money\TodayIncomeCache;
use App\Services\User\PersonPageQrcode;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\User\User
 *
 * @property int $id
 * @property string $nickname 昵称
 * @property string $avatar 头像url
 * @property string $qrcode_url 个人主页二维码 url
 * @property string $balance 余额
 * @property string $id_card 身份证号码
 * @property string $real_name 真实姓名
 * @property string $alipay_account 支付宝账号
 * @property string $personal_signature 个性签名
 * @property string $member_level 会员等级, normal: 普通会员不能发布内容， senior：高级会员可以发布内容
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAlipayAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIdCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMemberLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePersonalSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereQrcodeUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Database\Factories\User\UserFactory factory(...$parameters)
 * @property-read \Illuminate\Database\Eloquent\Collection|Material[] $materials
 * @property-read int|null $materials_count
 * @property-read \App\Models\User\SubUser|null $subUser
 * @property string $total_income 出售物料获得的累计收益
 * @property-read mixed $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTotalIncome($value)
 * @property-read mixed $today_income
 * @property string $qrcode_path 个人主页二维码的路径
 * @property-read \Illuminate\Database\Eloquent\Collection|Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|User whereQrcodePath($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|SubscribeMaterial[] $subscribeMaterials
 * @property-read int|null $subscribe_materials_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Order[] $soldOrders
 * @property-read int|null $sold_orders_count
 * @property-read int|null $sub_user_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User\SubUser[] $subUsers
 * @property-read int|null $sub_users_count
 * @property string $selected_material_poster_path 精选料包海报的路径
 * @property-read mixed $selected_material_poster_url
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSelectedMaterialPosterPath($value)
 */
class User extends Model
{
    use HasFactory;

    protected $table = 'u_user';

    protected $fillable = ['nickname', 'avatar', 'qrcode_path', 'balance', 'id_card', 'real_name', 'alipay_account',
        'personal_signature', 'member_level', 'total_income', 'today_income', 'qrcode_url',
        'selected_material_poster_path', 'selected_material_poster_url',];

    protected $visible = ['id', 'nickname', 'avatar', 'balance', 'today_income', 'total_income', 'personal_signature',
        'qrcode_url', 'member_level', 'qrcode_path', 'selected_material_poster_path', 'selected_material_poster_url'];

    protected $appends = ['qrcode_url', 'selected_material_poster_url'];

    public function materials()
    {
        return $this->hasMany(Material::class, 'uid');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'uid');
    }

    public function soldOrders()
    {
        return $this->hasMany(Order::class, 'author_uid');
    }

    public function subUsers()
    {
        return $this->hasMany(SubUser::class, 'uid');
    }

    public function subscribeMaterials()
    {
        return $this->hasMany(SubscribeMaterial::class, 'uid');
    }

    public function getTodayIncomeAttribute()
    {
        $incomeService = new TodayIncomeCache($this->attributes['id']);
        $todayIncome = $incomeService->get();
        return $todayIncome;
    }

    public function getQrcodeUrlAttribute()
    {
        if ($this->attributes['qrcode_path']) {
            $qrcodePath = $this->attributes['qrcode_path'];
        } else {
            $qrcodeGenerator = new PersonPageQrcode($this->attributes['id']);
            $qrcodePath = $qrcodeGenerator->set();
        }

        $qrcodeUrl = storageUrl($qrcodePath);
        return $qrcodeUrl;
    }

    public function getSelectedMaterialPosterUrlAttribute()
    {
        if (!$this->attributes['selected_material_poster_path']) {
            return '';
        }

        $selectedMaterialPosterUrl = storageUrl($this->attributes['selected_material_poster_path']);
        return $selectedMaterialPosterUrl;
    }
}
