<?php

class ForumController extends BaseController
{
	public function index()
	{
		$groups = ForumGroup::all();
		$categories = ForumCategory::all();

		return View::make('forum.index')->with('groups', $groups)->with('categories', $categories);
	}

	public function category($id)
	{
		$category = ForumCategory::find($id);

		if($category == null)
		{
			return Redirect::route('forum-home')->with('fail', "That category does not exist");
		}

		$threads = $category->threads()->get();

		return View::make('forum.category')->with('category', $category)->with('threads', $threads);
	}

	public function storeGroup()
	{
		$check = Validator::make(Input::all(), array(
			'group_name' => 'required|unique:forum_groups,title'
		));
		if (!$check->fails())
		{
			$section = new ForumGroup;

			$section->author_id = Auth::user()->id;
			$section->title = Input::get('group_name');

			if(!$section->save())
			{
				return Redirect::route('forum-home')->with('fail', 'An error has occured');
			}
			else
			{
				return Redirect::route('forum-home')->with('success', 'The group was created');
			}
		}
		else
		{
			return Redirect::route('forum-home')->withInput()->withErrors($check)->with('modal', '#section_form');
		}
	}

	public function deleteGroup($id)
	{
		$section = ForumGroup::find($id);

		if($section == null)
		{
			return Redirect::route('forum-home')->with('fail', 'That section does not exist.');
		}

		/*$categories = ForumCategory::where('group_id', $id);
		$threads = ForumThread::where('group_id', $id);
		$comments = ForumComment::where('group_id', $id);*/

		//accomplished by using relationships of models
		$threads = $section->threads();
		$comments = $section->comments();
		$categories = $section->categories();

		$del_threads = true;
		$del_comments = true;
		$del_category = true;

		if($threads->count() > 0)
		{
			$del_threads = $threads->delete();
		}

		if($comments->count() > 0)
		{
			$del_comments = $comments->delete();
		}

		if($categories->count() > 0)
		{
			$del_category = $categories->delete();
		}


		if (!($del_category && $del_threads && $del_comments && $section->delete()))
		{
			return Redirect::route('forum-home')->with('fail', 'An error occured while deleting the section.');
		}
		else
		{
			return Redirect::route('forum-home')->with('success', 'The section was deleted.');
		}
	}

	public function deleteCategory($id)
	{
		$category = ForumCategory::find($id);

		if($category == null)
		{
			return Redirect::route('forum-home')->with('fail', 'That category does not exist.');
		}

		$threads = $category->threads();
		$comments = $category->comments();

		$del_threads = true;
		$del_comments = true;

		if($threads->count() > 0)
		{
			$del_threads = $threads->delete();
		}
		if($comments->count() > 0)
		{
			$del_comments = $comments->delete();
		}


		if (!($del_threads && $del_comments && $category->delete()))
		{
			return Redirect::route('forum-home')->with('fail', 'An error occured');
		}

		else
		{
			return Redirect::route('forum-home')->with('success', 'The category was deleted.');
		}
	}

	public function storeCategory($id)
	{
		$check = Validator::make(Input::all(), array(
			'category_name' => 'required|unique:forum_categories,title'
		));

		if (!($check->fails()))
		{
			$group = ForumGroup::find($id);
			if ($group == null)
			{
				return Redirect::route('forum-home')->with('fail', "That group does not exist.");
			}

			$category = new ForumCategory;

			$category->title = Input::get('category_name');
			$category->author_id = Auth::user()->id;
			$category->group_id = $id;

			if($category->save())
			{
				return Redirect::route('forum-home')->with('success', 'The category was created');
			}
			else
			{
				return Redirect::route('forum-home')->with('fail', 'An error occured while saving the new category.');
			}
		}

		else
		{
			return Redirect::route('forum-home')->withInput()->withErrors($check)->with('category-modal', '#category_modal')->with('group-id', $id);	
		}
	}

	public function storeThread($id)
		{
			$category = ForumCategory::find($id);

			if($category == null)
			{
				return Redirect::route('forum-get-new-thread')->with('fail', 'invalid category');
			}

			$check = Validator::make(Input::all(), array(
				'title' => 'required|min:5|max:255',
				'body' => 'required|min:5'
			));

			if($check->fails())
			{
				return Redirect::route('forum-get-new-thread')->withInput()->withErrors($check)->with('fail', "Does not fit the requirements");

			}
			else
			{
				$thread = new ForumThread;
				
				$thread->title = Input::get('title');
				$thread->body = Input::get('body');
				$thread->category_id = $id;
				$thread->group_id = $category->group_id;
				$thread->author_id = Auth::user()->id;

				if ($thread->save())
				{
					return Redirect::route('forum-thread', $thread->id)->with('success', "Thread has been saved successfully");
				}
				else
				{
					return Redirect::route('forum-get-new-thread', $id)->with('fail', "An error has occured")->withInput();
				}
			}
		}

	public function newThread($id)
	{
		return View::make('forum.newthread')->with('id', $id);
	}

	public function thread($id)
	{
		$thread = ForumThread::find($id);
		if($thread == null)
		{
			return Redirect::route('forum-home')->with('fail', "Does not exist");
		}
		else
		{
			$author = $thread->author()->first()->username;
			return View::make('forum.thread')->with('thread', $thread)->with('author', $author);
		}
	}

	public function deleteThread($id)
	{
		$thread = ForumThread::find($id);
		if($thread == null)
		{
			return Redirect::route('forum-home')->with('fail', "Thread does not exist");
		}

		$comments = $thread->comments;
		$category_id = $thread->category_id;

		if($comments->count() > 0)
		{
			if($comments->delete() && $thread->delete())
			{
				return Redirect::route('forum-category', $category_id)->with('success', 'Post was deleted');
			}
			else
			{
				return Redirect::route('forum-category', $category_id)->with('fail', 'An error occured');
			}
		}
		else
		{
			if($thread->delete())
			{
				return Redirect::route('forum-category', $category_id)->with('success', 'Post was deleted');
			}
			else
			{
				return Redirect::route('forum-category', $category_id)->with('fail', 'An error occured');
			}
		}
	}

	public function storeComment($id)
	{
		$thread = ForumThread::find($id);
		if($thread == null)
			Redirect::route('forum-home')->with('fail', 'Thread does not exist');

		$validator = Validator::make(Input::all(), array(
			'body' => 'required|min:3'
		));

		if($validator->fails())
			return Redirect::route('forum-thread', $id)->withInput()->withErrors($validator)->with('fail', "Requirements are not met");
		else
		{
			$comment = new ForumComment();
			$comment->body = Input::get('body');
			$comment->author_id = Auth::user()->id;
			$comment->thread_id = $id;
			$comment->category_id = $thread->category->id;
			$comment->group_id = $thread->group->id;

			if($comment->save())
				return Redirect::route('forum-thread', $id)->with('success', "Comment posted successfully");
			else
				return Redirect::route('forum-thread', $id)->with('fail', "An error has occured");
		}
	}

	public function deleteComment($id)
	{
		$comment = ForumComment::find($id);

		if ($comment == null)
			return Redirect::route('forum-home')->with('fail', "That comment does not exist.");

		$threadid = $comment->thread->id;
		
		if ($comment->delete())
			return Redirect::route('forum-thread', $threadid)->with('success', "Comment was deleted.");
		else
			return Redirect::route('forum-thread', $threadid)->with('fail', "An error occured");
	}
}