/**
 * Created by linsen on 2017/12/19.
 */
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import AddMottos from './AddMottos';

class Main extends  Component{
    constructor(){
        super();
        this.state={
            mottos:[]
        }
        this.hanleAddMottos=this.hanleAddMottos.bind(this);
    }
    hanleAddMottos(mottos){
        fetch('api/add/',{
            method:"post",
            headers:{
                'Accept':'application/json',
                'Content-Type':'application/json'
            },
            body:JSON.stringify(mottos)
        })
            .then(response=>{
                alert(JSON.stringify(response))
            })
    }
    render(){
        return(
            <AddMottos onAdd={this.hanleAddMottos}/>
        );
    }
}
export  default  Main;
if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
}
