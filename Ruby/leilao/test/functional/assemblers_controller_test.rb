require 'test_helper'

class AssemblersControllerTest < ActionController::TestCase
  setup do
    @assembler = assemblers(:one)
  end

  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:assemblers)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create assembler" do
    assert_difference('Assembler.count') do
      post :create, :assembler => @assembler.attributes
    end

    assert_redirected_to assembler_path(assigns(:assembler))
  end

  test "should show assembler" do
    get :show, :id => @assembler.to_param
    assert_response :success
  end

  test "should get edit" do
    get :edit, :id => @assembler.to_param
    assert_response :success
  end

  test "should update assembler" do
    put :update, :id => @assembler.to_param, :assembler => @assembler.attributes
    assert_redirected_to assembler_path(assigns(:assembler))
  end

  test "should destroy assembler" do
    assert_difference('Assembler.count', -1) do
      delete :destroy, :id => @assembler.to_param
    end

    assert_redirected_to assemblers_path
  end
end
