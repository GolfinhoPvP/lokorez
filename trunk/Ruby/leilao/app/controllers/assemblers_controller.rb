class AssemblersController < ApplicationController
  # GET /assemblers
  # GET /assemblers.xml
  def index
    @assemblers = Assembler.all

    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @assemblers }
    end
  end

  # GET /assemblers/1
  # GET /assemblers/1.xml
  def show
    @assembler = Assembler.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @assembler }
    end
  end

  # GET /assemblers/new
  # GET /assemblers/new.xml
  def new
    @assembler = Assembler.new

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @assembler }
    end
  end

  # GET /assemblers/1/edit
  def edit
    @assembler = Assembler.find(params[:id])
  end

  # POST /assemblers
  # POST /assemblers.xml
  def create
    @assembler = Assembler.new(params[:assembler])

    respond_to do |format|
      if @assembler.save
        format.html { redirect_to(@assembler, :notice => 'Assembler was successfully created.') }
        format.xml  { render :xml => @assembler, :status => :created, :location => @assembler }
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @assembler.errors, :status => :unprocessable_entity }
      end
    end
  end

  # PUT /assemblers/1
  # PUT /assemblers/1.xml
  def update
    @assembler = Assembler.find(params[:id])

    respond_to do |format|
      if @assembler.update_attributes(params[:assembler])
        format.html { redirect_to(@assembler, :notice => 'Assembler was successfully updated.') }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @assembler.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /assemblers/1
  # DELETE /assemblers/1.xml
  def destroy
    @assembler = Assembler.find(params[:id])
    @assembler.destroy

    respond_to do |format|
      format.html { redirect_to(assemblers_url) }
      format.xml  { head :ok }
    end
  end
end
