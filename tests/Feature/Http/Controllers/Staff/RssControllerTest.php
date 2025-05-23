<?php

declare(strict_types=1);

/**
 * NOTICE OF LICENSE.
 *
 * UNIT3D Community Edition is open-sourced software licensed under the GNU Affero General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D Community Edition
 *
 * @author     HDVinnie <hdinnovations@protonmail.com>
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 */

use App\Http\Controllers\Staff\RssController;
use App\Http\Requests\Staff\StoreRssRequest;
use App\Http\Requests\Staff\UpdateRssRequest;
use App\Models\Category;
use App\Models\TmdbGenre;
use App\Models\Resolution;
use App\Models\Rss;
use App\Models\Type;
use App\Models\User;

test('create returns an ok response', function (): void {
    $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

    $categories = Category::factory()->times(3)->create();
    $types = Type::factory()->times(3)->create();
    $resolutions = Resolution::factory()->times(3)->create();
    $genres = TmdbGenre::factory()->times(3)->create();
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('staff.rss.create'));

    $response->assertOk();
    $response->assertViewIs('Staff.rss.create');
    $response->assertViewHas('categories', $categories);
    $response->assertViewHas('types', $types);
    $response->assertViewHas('resolutions', $resolutions);
    $response->assertViewHas('genres', $genres);
    $response->assertViewHas('user', $user);

    // TODO: perform additional assertions
});

test('destroy returns an ok response', function (): void {
    $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

    $rss = Rss::factory()->create();
    $user = User::factory()->create();

    $response = $this->actingAs($user)->delete(route('staff.rss.destroy', [$rss]));

    $response->assertOk();
    $this->assertModelMissing($rss);

    // TODO: perform additional assertions
});

test('destroy aborts with a 403', function (): void {
    $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

    $rss = Rss::factory()->create();
    $user = User::factory()->create();

    // TODO: perform additional setup to trigger `abort_if(403)`...

    $response = $this->actingAs($user)->delete(route('staff.rss.destroy', [$rss]));

    $response->assertForbidden();
});

test('edit returns an ok response', function (): void {
    $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

    $rss = Rss::factory()->create();
    $categories = Category::factory()->times(3)->create();
    $types = Type::factory()->times(3)->create();
    $resolutions = Resolution::factory()->times(3)->create();
    $genres = TmdbGenre::factory()->times(3)->create();
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('staff.rss.edit', [$rss]));

    $response->assertOk();
    $response->assertViewIs('Staff.rss.edit');
    $response->assertViewHas('categories', $categories);
    $response->assertViewHas('types', $types);
    $response->assertViewHas('resolutions', $resolutions);
    $response->assertViewHas('genres', $genres);
    $response->assertViewHas('user', $user);
    $response->assertViewHas('rss', $rss);

    // TODO: perform additional assertions
});

test('edit aborts with a 403', function (): void {
    $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

    $rss = Rss::factory()->create();
    $categories = Category::factory()->times(3)->create();
    $types = Type::factory()->times(3)->create();
    $resolutions = Resolution::factory()->times(3)->create();
    $genres = TmdbGenre::factory()->times(3)->create();
    $user = User::factory()->create();

    // TODO: perform additional setup to trigger `abort_if(403)`...

    $response = $this->actingAs($user)->get(route('staff.rss.edit', [$rss]));

    $response->assertForbidden();
});

test('index returns an ok response', function (): void {
    $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

    $rsses = Rss::factory()->times(3)->create();
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('staff.rss.index'));

    $response->assertOk();
    $response->assertViewIs('Staff.rss.index');
    $response->assertViewHas('public_rss');

    // TODO: perform additional assertions
});

test('store validates with a form request', function (): void {
    $this->assertActionUsesFormRequest(
        RssController::class,
        'store',
        StoreRssRequest::class
    );
});

test('store returns an ok response', function (): void {
    $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('staff.rss.store'), [
        // TODO: send request data
    ]);

    $response->assertOk();

    // TODO: perform additional assertions
});

test('update validates with a form request', function (): void {
    $this->assertActionUsesFormRequest(
        RssController::class,
        'update',
        UpdateRssRequest::class
    );
});

test('update returns an ok response', function (): void {
    $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

    $rss = Rss::factory()->create();
    $user = User::factory()->create();

    $response = $this->actingAs($user)->patch(route('staff.rss.update', [$rss]), [
        // TODO: send request data
    ]);

    $response->assertOk();

    // TODO: perform additional assertions
});

test('update aborts with a 403', function (): void {
    $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

    $rss = Rss::factory()->create();
    $user = User::factory()->create();

    // TODO: perform additional setup to trigger `abort_if(403)`...

    $response = $this->actingAs($user)->patch(route('staff.rss.update', [$rss]), [
        // TODO: send request data
    ]);

    $response->assertForbidden();
});

// test cases...
