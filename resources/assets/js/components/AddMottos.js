/**
 * Created by linsen on 2017/12/19.
 */
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
class AddMottos extends  Component{
    constructor(props){
        super(props);
        this.state={
            newMotto: {
                pic: '',
                englishWord: '',
                chineseWord: '',
                xiaobian: ''
            }
        }
        this.handleSubmit=this.handleSubmit.bind(this);
        this.handleInput=this.handleInput.bind(this);
    }
    handleInput(key,e){
        var state=Object.assign({},this.state.newMotto);
        state[key]=e.target.value;
        this.setState({newMotto:state});
    }
    handleSubmit(e){
        e.preventDefault();
        this.props.onAdd(this.state.newMotto);
    }
    render(){
        const divStyle={
        }
        return(
            <div>
                <h3>添加信息</h3>
                <div style={divStyle}>
                    <form onSubmit={this.handleSubmit}>
                        <lable> 英文:
                            <input type="text" onChange={(e)=>this.handleInput('englishWord',e)} />
                        </lable>
                        <lable> 中文:
                            <input type="text" onChange={(e)=>this.handleInput('chineseWord',e)} />
                        </lable>
                        <lable> 总结:
                            <input type="text" onChange={(e)=>this.handleInput('xiaobian',e)} />
                        </lable>
                        <lable> 图片:
                            <input type="text" onChange={(e)=>this.handleInput('pic',e)} />
                        </lable>
                        <input type="submit" value="提交"/>
                    </form>
                </div>
            </div>
        );
    }
}
export  default  AddMottos;

