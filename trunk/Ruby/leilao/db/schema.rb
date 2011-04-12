# This file is auto-generated from the current state of the database. Instead
# of editing this file, please use the migrations feature of Active Record to
# incrementally modify your database, and then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your
# database schema. If you need to create the application database on another
# system, you should be using db:schema:load, not running all the migrations
# from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended to check this file into your version control system.

ActiveRecord::Schema.define(:version => 20110412154318) do

  create_table "assemblers", :force => true do |t|
    t.string   "name"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "auctions", :force => true do |t|
    t.integer  "car_code"
    t.datetime "auction_start"
    t.decimal  "initial_value", :precision => 10, :scale => 0
    t.decimal  "buy_now_value", :precision => 10, :scale => 0
    t.decimal  "capping_value", :precision => 10, :scale => 0
    t.boolean  "status"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "auctions", ["car_code"], :name => "index_auctions_on_car_code"

  create_table "cars", :force => true do |t|
    t.integer  "mod_code"
    t.string   "engine"
    t.string   "plate"
    t.string   "colour"
    t.integer  "mileage"
    t.integer  "manufacture_year"
    t.integer  "model_year"
    t.text     "comments"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "cars_optionals", :id => false, :force => true do |t|
    t.integer "car_id"
    t.integer "optional_id"
  end

  create_table "cities", :force => true do |t|
    t.integer  "est_code"
    t.string   "name"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "cities", ["est_code"], :name => "index_cities_on_est_code"

  create_table "clients", :force => true do |t|
    t.string   "cpf"
    t.integer  "cit_code"
    t.string   "name"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "fuels", :force => true do |t|
    t.string   "name"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "models", :force => true do |t|
    t.string   "name"
    t.datetime "created_at"
    t.datetime "updated_at"
    t.integer  "ass_code"
  end

  create_table "optionals", :force => true do |t|
    t.string   "name"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  create_table "states", :force => true do |t|
    t.string   "name"
    t.string   "acronym"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

end
